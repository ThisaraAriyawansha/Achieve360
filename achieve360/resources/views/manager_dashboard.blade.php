<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-blue-900">
            <div class="px-6 py-4 text-2xl font-semibold border-b border-blue-800">
            Manager Dashboard
            </div>
            <nav class="flex-1 p-4 space-y-2 text-base">
                <a href="#" onclick="showDashboard()" class="block px-4 py-2 transition-all duration-200 bg-blue-800 rounded-lg hover:bg-blue-700">Dashboard</a>
                <button onclick="openRoleSelectionModal()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Register</button>
                <button onclick="showCourseRegistrationForm()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Add Course</button>
                <button onclick="openAssignCourseForm()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Assign Course</button>
                    <button onclick="showviewEnrolledCourses()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">
                                View Enrolled Courses
                    </button>
                <a href="{{ route('login') }}" id="logout-link" class="block px-4 py-2 mt-4 text-center transition-all duration-200 bg-red-700 rounded-lg hover:bg-red-600">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Navbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-blue-600 transition-all duration-200 bg-white border border-blue-600 rounded-lg hover:bg-blue-100">
                        Welcome, {{ session('full_name') }}
                    </button>
                </div>
            </header>

            <!-- Success & Error Messages -->
            @if (session('success'))
                <div id="success-message" class="w-1/2 p-4 mx-auto mb-4 text-center text-white bg-green-500 rounded-lg shadow-md opacity-100">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div id="error-message" class="w-1/2 p-2 mx-auto mb-2 text-sm text-center text-white bg-red-500 rounded-lg shadow-md opacity-100">
                    <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <!-- Dynamic Content Area -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                <!-- Dashboard Content -->
                <section id="dashboard-content" class="block">
                    <h3 class="text-2xl font-semibold text-gray-800">Welcome to the Dashboard</h3>
                    <p class="mt-4 text-gray-700">Use the sidebar to navigate and manage registrations.</p>
                </section>


              <!-- Course Registration Form -->
                 <section id="course-registration-form" class="hidden">
                    <h3 class="mb-4 text-2xl font-semibold text-gray-800">Add Course</h3>
                    <form id="courseRegistrationForm" class="w-full max-w-md p-6 mx-auto space-y-4 bg-white rounded-lg shadow-lg" method="POST" action="/register_course">
                        @csrf
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Course Name</label><input type="text" name="name" id="course-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Course Description</label><textarea name="description" id="course-description" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea></div>
                        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Add Course</button>
                    </form>
                </section>   
                
<!-- Assign Course Form -->
<section id="assign-course-form" class="hidden">
    <h3 class="mb-4 text-2xl font-semibold text-gray-800">Assign Course</h3>
    <form id="assignCourseForm" class="w-full max-w-md p-6 mx-auto space-y-4 bg-white rounded-lg shadow-lg" method="POST" action="/assign_course">
        @csrf
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Select Course</label>
            <select id="course" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <!-- Course options will be populated here -->
            </select>
        </div>
        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Select Teacher</label>
            <select id="teacher" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                <!-- Teacher options will be populated here -->
            </select>
        </div>
        <button type="button" onclick="assignCourse()" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Assign Course</button>
    </form>
</section>




                <!-- Course Management Section -->
                <section id="course-management" class="hidden">
                    <h3 class="mb-4 text-2xl font-semibold text-gray-800">Course Management</h3>
                    <div id="course-list" class="space-y-4">
                        <!-- Courses will be dynamically loaded here -->
                    </div>
                </section>


                            <!-- Course Assignment Section -->
            <section id="course-assignment" class="hidden">
                <h3 class="mb-4 text-2xl font-semibold text-gray-800">Assigned Courses</h3>
                <div id="assigned-course-list" class="space-y-4">
                    <!-- Assigned courses will be dynamically loaded here -->
                </div>
            </section>

                
                <!-- Registration Form -->
                <section id="registration-form" class="hidden">
                    <h3 id="form-title" class="mb-4 text-2xl font-semibold text-gray-800">Register</h3>
                    <form id="registrationForm" class="w-full max-w-md p-6 mx-auto space-y-4 bg-white rounded-lg shadow-lg" method="POST" action="/register_member">
                        @csrf
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Username</label><input type="text" name="username" id="username" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Email</label><input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Password</label><input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Full Name</label><input type="text" name="full_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></div>
                        <div><label class="block mb-1 text-sm font-medium text-gray-700">Role</label><input type="text" id="role" name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg" readonly></div>
                        <button type="submit" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Register</button>
                    </form>

                    <!-- QR Code Section (For Student Only) -->
                    <div id="qr-code-section" class="hidden">
                    <canvas id="qr-code" style="display: none;"></canvas>
                    <button onclick="downloadQRCode()" class="w-full px-4 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Download QR Code</button>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <!-- Role Selection Modal -->
    <div id="role-selection-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50">
        <div class="w-1/3 p-6 bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">Select a Role to Register</h3>
            <button onclick="selectRole('student')" class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg">Student</button>
            <button onclick="selectRole('teacher')" class="w-full px-4 py-2 mt-2 text-white bg-blue-600 rounded-lg">Teacher</button>
            <button onclick="selectRole('admin')" class="w-full px-4 py-2 mt-2 text-white bg-blue-600 rounded-lg">Admin</button>
            <button onclick="selectRole('manager')" class="w-full px-4 py-2 mt-2 text-white bg-blue-600 rounded-lg">Manager</button>
            <button onclick="closeRoleSelectionModal()" class="mt-4 text-blue-600">Cancel</button>
        </div>
    </div>

    <script>
        function showDashboard() {
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('assign-course-form').classList.add('hidden');
            document.getElementById('dashboard-content').classList.remove('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');
            document.getElementById('enrolled-courses-container').classList.add('hidden');
            hideAllSections();
            

        }

        function openRoleSelectionModal() {
            document.getElementById('role-selection-modal').classList.remove('hidden');
        }

        function closeRoleSelectionModal() {
            document.getElementById('role-selection-modal').classList.add('hidden');
        }

        function selectRole(role) {
            closeRoleSelectionModal();
            showRegistrationForm(role);
        }

        function showRegistrationForm(role) {
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('assign-course-form').classList.add('hidden');

            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('registration-form').classList.remove('hidden');
            document.getElementById('form-title').textContent = `Register New ${role}`;
            document.getElementById('role').value = role;

            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');
            document.getElementById('course-management').classList.add('hidden');


            const qrCodeSection = document.getElementById('qr-code-section');
            if (role === 'student') {
                qrCodeSection.classList.remove('hidden');
            } else {
                qrCodeSection.classList.add('hidden');
            }
        }

        function generateQRCode() {
            const email = document.getElementById('email').value;
            if (email) {
                const qr = new QRious({
                    element: document.getElementById('qr-code'),
                    value: email,
                    size: 150
                });
            }
        }

        function downloadQRCode() {
            const canvas = document.getElementById('qr-code');
            const link = document.createElement('a');
            const username = document.getElementById('username').value || 'QRCode'; // Use 'QRCode' if username is empty
            link.href = canvas.toDataURL();
            link.download = `${username}_QRCode.png`;
            link.click();
        }

        document.getElementById('email').addEventListener('input', function () {
            const role = document.getElementById('role').value;
            if (role === 'student') {
                generateQRCode();
            }
        });



        document.addEventListener('DOMContentLoaded', function () {
        // Handle success message fade-out after 3 seconds
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0'); // Fade out
                successMessage.classList.remove('opacity-100');
            }, 3000); // Show for 3 seconds
        }

        // Handle error message fade-out after 3 seconds
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('opacity-0'); // Fade out
                errorMessage.classList.remove('opacity-100');
            }, 3000); // Show for 3 seconds
        }
    });





        function openAssignCourseForm() {
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('assign-course-form').classList.remove('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');



    // Fetch courses and teachers
    fetchCourses();
    fetchTeachers();
}



function fetchCourses() {
    fetch('/api/courses')
        .then(response => response.json())
        .then(data => {
            const courseSelect = document.getElementById('course');
            data.courses.forEach(course => {
                const option = document.createElement('option');
                option.value = course.name;  // Use course name as the value
                option.textContent = course.name;
                courseSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching courses:', error));
}

function fetchTeachers() {
    fetch('/api/teachers')
        .then(response => response.json())
        .then(data => {
            console.log('Teacher data:', data); // Check the data structure here
            const teacherSelect = document.getElementById('teacher');

            // Convert the object to an array of values
            const teacherNames = Object.values(data.teachers);

            if (Array.isArray(teacherNames)) {
                teacherNames.forEach(teacherName => {
                    const option = document.createElement('option');
                    option.value = teacherName;  // Use teacher name as the value
                    option.textContent = teacherName;
                    teacherSelect.appendChild(option);
                });
            } else {
                console.error('Expected an array of teacher names');
            }
        })
        .catch(error => console.error('Error fetching teachers:', error));
}





function assignCourse() {
    const courseName = document.getElementById('course').value;
    const teacherName = document.getElementById('teacher').value;

    fetch('/assign_course', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ course_name: courseName, teacher_name: teacherName })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Course assigned successfully');
        } else {
            alert('Error assigning course');
        }
    })
    .catch(error => console.error('Error:', error));
}




// Hide all sections by default
function hideAllSections() {
    document.getElementById('manage-admins').classList.add('hidden');
    document.getElementById('manage-managers').classList.add('hidden');
    document.getElementById('manage-teachers').classList.add('hidden');
    document.getElementById('manage-students').classList.add('hidden');
    document.getElementById('course-assignment').classList.add('hidden');
    document.getElementById('course-management').classList.add('hidden');

}



function updateStatus(id, role) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(`/update_status/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ status: 'Inactive', role: role })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.message === 'Status updated successfully') {
            document.getElementById(`status-${id}`).innerText = 'Inactive';
        } else {
            alert('Failed to update status');
        }
    })
    .catch(error => console.error('Error:', error));
}


function showCourseManagement() {
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('assign-course-form').classList.add('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');
            document.getElementById('course-management').classList.remove('hidden');

    // Fetch courses from the server and display them
    fetch('/api/courses') // Assuming the endpoint to get courses is '/api/courses'
        .then(response => response.json())
        .then(data => {
            const courseList = document.getElementById('course-list');
            courseList.innerHTML = ''; // Clear existing content
            data.courses.forEach(course => {
                const courseItem = document.createElement('div');
                courseItem.classList.add('p-4', 'bg-white', 'rounded-lg', 'shadow-lg', 'border', 'border-gray-200');
                courseItem.innerHTML = `
                    <h4 class="text-xl font-semibold text-gray-800">${course.name}</h4>
                    <p class="mt-2 text-gray-600">${course.description}</p>
                    <button onclick="deleteCourses(${course.id})" class="px-4 py-2 mt-4 text-white bg-red-600 rounded-lg hover:bg-red-700">Delete</button>
                `;
                courseList.appendChild(courseItem);
            });
        })
        .catch(error => {
            console.error('Error fetching courses:', error);
        });
}

function deleteCourses(courseId) {
    const confirmDelete = confirm('Are you sure you want to delete this course?');
    if (confirmDelete) {
        const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

        fetch(`/api/courses/${courseId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken, // Add CSRF token here
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Course deleted successfully');
                showCourseManagement(); // Reload the courses list after deletion
            } else {
                alert('Failed to delete course');
            }
        })
        .catch(error => {
            console.error('Error deleting course:', error);
            alert('An error occurred while deleting the course');
        });
    }
}


function showCourseAssignment() {
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('assign-course-form').classList.add('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.remove('hidden');

    // Fetch the assigned courses from the server
    fetch('/assigned_courses')  // Your backend route to fetch assigned courses
        .then(response => response.json())
        .then(data => {
            const assignmentList = document.getElementById('assigned-course-list');
            assignmentList.innerHTML = '';  // Clear existing content

            data.courses.forEach(course => {
                const courseItem = document.createElement('div');
                courseItem.classList.add('p-4', 'bg-white', 'rounded-lg', 'shadow-lg', 'border', 'border-gray-300', 'mb-4');
                courseItem.innerHTML = `
                    <h4 class="text-lg font-semibold text-gray-800">Course: ${course.course_name}</h4>
                    <p class="text-sm text-gray-600">Instructor: ${course.teacher_name}</p>
                    <p class="text-sm text-gray-500">Assigned on: ${new Date(course.assigned_at).toLocaleDateString()}</p>
                    <button onclick="deleteCourse(${course.id})" class="px-4 py-2 mt-4 text-white bg-red-500 rounded-lg hover:bg-red-600">
                        Delete Course
                    </button>
                `;
                assignmentList.appendChild(courseItem);
            });
        })
        .catch(error => console.error('Error fetching assigned courses:', error));
}

function deleteCourse(courseId) {
    if (confirm('Are you sure you want to delete this course?')) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Fetch CSRF token

        fetch(`/assigned_courses/${courseId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,  // Include CSRF token
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showCourseAssignment();  // Reload list on success
            } else {
                alert('Error deleting course. Please try again.');
            }
        })
        .catch(error => console.error('Error deleting course:', error));
    }
}



function showviewEnrolledCourses() {
    const sectionsToHide = [
        'course-registration-form', 
        'assign-course-form', 
        'dashboard-content', 
        'registration-form', 
        'course-management', 
        'course-assignment'
    ];
    
    sectionsToHide.forEach(section => {
        document.getElementById(section).classList.add('hidden');
    });

    viewEnrolledCourses();
}

function viewEnrolledCourses() {
    fetch('/view-enrolled-courses-management', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(courses => {
        let courseContent = `
            <h3 class="mb-6 text-2xl font-semibold text-gray-800">Your Enrolled Courses</h3>
            <div class="container px-4 mx-auto" id="enrolled-courses-container">
                <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-100">
                            <tr class="text-left">
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Course Name</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Lecturer Name</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Marks</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Attendance</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Student Name</th>
                                <th class="px-6 py-3 text-sm font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
        `;

        if (courses.error) {
            courseContent = `<p class="text-red-500">${courses.error}</p>`;
        } else {
            courses.forEach((course, index) => {
                courseContent += `
                    <tr class="transition-colors duration-200 border-t hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <div class="flex items-center">
                                <i class="mr-2 text-indigo-600 fas fa-book-open"></i>
                                ${course.course_name}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="mr-2 text-green-600 fas fa-user-tie"></i>
                                ${course.teacher_name}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="mr-2 text-yellow-500 fas fa-check-circle"></i>
                                ${course.marks}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="mr-2 text-purple-500 fas fa-calendar-check"></i>
                                ${course.attendance_count}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <i class="mr-2 text-blue-500 fas fa-user-graduate"></i>
                                ${course.full_name}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <button class="px-4 py-2 font-semibold text-white bg-blue-500 rounded generate-report-btn hover:bg-blue-600" data-course='${JSON.stringify(course)}'>
                                Generate Report
                            </button>
                        </td>
                    </tr>
                `;
            });
        }

        courseContent += `
                    </tbody>
                </table>
            </div>
        </div>
        `;

        // Populate the content dynamically
        document.getElementById('dashboard-content').innerHTML = courseContent;

        // Show the 'enrolled-courses-container' now that the content is loaded
        document.getElementById('enrolled-courses-container').classList.remove('hidden');
        document.getElementById('dashboard-content').classList.remove('hidden');

        // Attach event listeners to each report button
        document.querySelectorAll('.generate-report-btn').forEach(button => {
            button.addEventListener('click', () => {
                const course = JSON.parse(button.getAttribute('data-course'));
                generateReport(course);
            });
        });
    })
    .catch(error => {
        console.error('Error fetching enrolled courses:', error);
        alert('There was an error fetching your enrolled courses.');
    });
}

// Function to generate a simple report PDF for a specific course
// Function to generate a modern-looking report PDF in A4 landscape size for a specific course
function generateReport(course) {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('landscape', 'mm', 'a4'); // Landscape orientation, millimeters as units, A4 size

    // Define Colors
    const primaryColor = [0, 123, 255]; // Blue
    const secondaryColor = [100, 100, 100]; // Gray

    // Set up the header
    doc.setFillColor(...primaryColor);
    doc.rect(0, 0, doc.internal.pageSize.width, 30, 'F');
    doc.setTextColor(255, 255, 255);
    doc.setFontSize(24); // Increased font size for the header
    doc.setFont('helvetica', 'bold');
    doc.text('Course Report', 10, 20);

    // Add Course Details Section
    doc.setTextColor(...secondaryColor);
    doc.setFontSize(16); // Increased font size for section titles
    doc.setFont('helvetica', 'normal');

    // Create a vertical space after the header
    let yPos = 40;

    // Add course information with customized styling
    doc.setTextColor(...primaryColor);
    doc.setFontSize(18); // Increased font size for course information title
    doc.text('Course Information', 10, yPos);

    yPos += 12; // Increased space after title

    doc.setTextColor(...secondaryColor);
    doc.setFontSize(14); // Increased font size for labels
    doc.text(`Course Name: `, 10, yPos);
    doc.setTextColor(0, 0, 0);
    doc.text(`${course.course_name}`, 60, yPos);

    yPos += 10; // Increased spacing between fields

    doc.setTextColor(...secondaryColor);
    doc.text(`Lecturer Name: `, 10, yPos);
    doc.setTextColor(0, 0, 0);
    doc.text(`${course.teacher_name}`, 60, yPos);

    yPos += 10;

    doc.setTextColor(...secondaryColor);
    doc.text(`Student Name: `, 10, yPos);
    doc.setTextColor(0, 0, 0);
    doc.text(`${course.full_name}`, 60, yPos);

    yPos += 10;

    doc.setTextColor(...secondaryColor);
    doc.text(`Marks: `, 10, yPos);
    doc.setTextColor(0, 0, 0);
    doc.text(`${course.marks}`, 60, yPos);

    yPos += 10;

    doc.setTextColor(...secondaryColor);
    doc.text(`Attendance Count: `, 10, yPos);
    doc.setTextColor(0, 0, 0);
    doc.text(`${course.attendance_count}`, 60, yPos);

    yPos += 20; // Increased space before footer

    // Add a footer
    doc.setDrawColor(...primaryColor);
    doc.line(10, yPos, doc.internal.pageSize.width - 10, yPos);
    doc.setFontSize(12); // Increased footer font size
    doc.setTextColor(...secondaryColor);
    doc.text("Generated by ACHIEVE360 LMS System", 10, yPos + 10);

    // Save the PDF
    doc.save(`Course_Report_${course.course_name}.pdf`);
}



        function showCourseRegistrationForm() {
            document.getElementById('course-registration-form').classList.remove('hidden');
            document.getElementById('assign-course-form').classList.add('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');
            document.getElementById('enrolled-courses-container').classList.add('hidden');

        }
        

        document.addEventListener('DOMContentLoaded', function () {
        // Handle success message fade-out after 3 seconds
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.classList.add('opacity-0'); // Fade out
                successMessage.classList.remove('opacity-100');
            }, 3000); // Show for 3 seconds
        }

        // Handle error message fade-out after 3 seconds
        const errorMessage = document.getElementById('error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('opacity-0'); // Fade out
                errorMessage.classList.remove('opacity-100');
            }, 3000); // Show for 3 seconds
        }
    });


    </script>
</body>
</html>
