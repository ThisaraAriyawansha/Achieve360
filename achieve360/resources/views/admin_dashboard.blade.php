<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-blue-900">
            <div class="px-6 py-4 text-2xl font-semibold border-b border-blue-800">
            Admin Dashboard
            </div>
            <nav class="flex-1 p-4 space-y-2 text-base">
                <a href="#" onclick="showDashboard()" class="block px-4 py-2 transition-all duration-200 bg-blue-800 rounded-lg hover:bg-blue-700">Dashboard</a>
                <button onclick="openRoleSelectionModal()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Register</button>
                <button onclick="showCourseRegistrationForm()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Add Course</button>
                <a href="#" onclick="showCourseManagement()" class="block px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Course Management</a>
                <a href="#" onclick="showCourseAssignment()" class="block px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Course Assignment</a>
                <button onclick="showAttendanceManagement()" class="block px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Attendance Management</button>

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



<!-- QR Code Reader (Initially Hidden) -->
<div id="qr-reader-container" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-blue-900 bg-opacity-50">
    <div class="w-full p-6 bg-white rounded-lg shadow-xl sm:w-96">
        <div id="qr-reader" class="w-full mb-4 h-80"></div>
        <button onclick="closeQRCodeScanner()" class="w-full px-6 py-2 text-white transition duration-300 bg-blue-600 rounded-lg shadow-md hover:bg-blue-500">
            Close Scanner
        </button>
    </div>
</div>

<!-- Attendance Form Section (Initially Hidden) -->
<div id="attendanceForm" class="hidden w-full p-8 mx-auto mt-10 bg-white rounded-lg shadow-lg sm:w-96">
    <label for="studentEmail" class="block mb-2 text-lg font-semibold text-gray-700">Student Email:</label>
    <input type="email" id="studentEmail" placeholder="Enter Student Email" class="w-full px-4 py-3 mb-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" readonly>

    <button onclick="loadStudentCourses()" class="w-full px-6 py-3 text-white transition duration-300 bg-blue-700 rounded-lg shadow-md hover:bg-blue-600">
        Load Courses
    </button>

    <div id="coursesList" class="mt-6 space-y-4">
        <!-- This will be populated dynamically with courses -->
    </div>
</div>

                
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
            <button onclick="selectRole('manager')" class="w-full px-4 py-2 mt-2 text-white bg-blue-600 rounded-lg">Manager</button>
            <button onclick="closeRoleSelectionModal()" class="mt-4 text-blue-600">Cancel</button>
        </div>
    </div>

    <script>
        function showDashboard() {
            document.getElementById('dashboard-content').classList.remove('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');


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
            document.getElementById('registration-form').classList.remove('hidden');
            document.getElementById('form-title').textContent = `Register New ${role}`;
            document.getElementById('role').value = role;
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');


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



        function showCourseRegistrationForm() {
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('course-registration-form').classList.remove('hidden');
            document.getElementById('course-management').classList.add('hidden');
            document.getElementById('course-assignment').classList.add('hidden');

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


// Show course management page and fetch courses
function showCourseManagement() {
    // Hide other sections and display course management
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('registration-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
    document.getElementById('course-management').classList.remove('hidden');
    document.getElementById('course-assignment').classList.add('hidden');

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

// Delete course by ID
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
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('registration-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
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


function showAttendanceManagement() {
        // Show QR code scanner
        document.getElementById("qr-reader-container").style.display = "block";
        document.getElementById("attendanceForm").style.display = "none";
        
        // Start scanning QR code
        startQRCodeScanner();
    }

    // Function to start QR code scanning
    function startQRCodeScanner() {
        const qrReaderContainer = document.getElementById("qr-reader");

        // Initialize QR code scanner
        const html5QrCode = new Html5Qrcode("qr-reader");

        // Start scanning QR code
        html5QrCode.start(
            { facingMode: "environment" },  // Use back camera for scanning
            { fps: 10, qrbox: 250 },  // Set frames per second and size of scanning box
            (decodedText) => {
                // When QR code is successfully scanned, populate the email field
                document.getElementById("studentEmail").value = decodedText;  // Fill the email input field

                // Stop the scanner after successful scan
                html5QrCode.stop().then(() => {
                    console.log("QR Code scan stopped.");
                    // Proceed to load courses after scanning
                    loadStudentCourses();
                }).catch((error) => {
                    console.log("Error stopping scanner:", error);
                });

                // Hide the QR code scanner and show the attendance form
                qrReaderContainer.style.display = "none";  // Hide QR scanner
                document.getElementById("attendanceForm").style.display = "block";  // Show attendance form
            },
            (errorMessage) => {
                console.log(errorMessage);  // Handle any scanning errors
            }
        ).catch((error) => {
            console.log("Error starting QR scanner:", error);
        });
    }

    // Function to close the QR scanner if needed
    function closeQRCodeScanner() {
        document.getElementById("qr-reader-container").style.display = "none";
    }

    // Function to fetch and display courses for the entered student email
    function loadStudentCourses() {
        const studentEmail = document.getElementById('studentEmail').value;

        if (!studentEmail) {
            alert('Please scan the QR code first.');
            return;
        }

        // Fetch courses for the student
        fetch(`/api/student/courses?email=${studentEmail}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                    return;
                }

                const coursesList = document.getElementById("coursesList");
                coursesList.innerHTML = ''; // Clear previous courses

                // Loop through each course and create the UI dynamically
                data.forEach(course => {
                    const courseElement = document.createElement("div");
                    courseElement.innerHTML = `
                        <input type="radio" name="course" value="${course.id}" id="course-${course.id}">
                        <label for="course-${course.id}">${course.course_name} - ${course.teacher_name}</label>
                        <button onclick="markAttendance(${course.id})" class="px-4 py-2 ml-4 text-white bg-green-500 rounded">Mark Attendance</button>
                    `;
                    coursesList.appendChild(courseElement);
                });
            });
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Function to mark attendance for a selected course
    function markAttendance(courseId) {
        fetch(`/api/attendance/mark/${courseId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken  // CSRF token for Laravel
            },
            body: JSON.stringify({})  // Request body (can be customized)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert(data.message);
            } else {
                alert('Error marking attendance.');
            }
        });
    }
</script>




    </script>
</body>
</html>
