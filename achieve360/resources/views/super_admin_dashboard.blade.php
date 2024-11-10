<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-blue-900">
            <div class="px-6 py-4 text-2xl font-semibold border-b border-blue-800">
                Super Admin
            </div>
            <nav class="flex-1 p-4 space-y-2 text-base">
                <a href="#" onclick="showDashboard()" class="block px-4 py-2 transition-all duration-200 bg-blue-800 rounded-lg hover:bg-blue-700">Dashboard</a>
                <button onclick="openRoleSelectionModal()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Register</button>
                <button onclick="showCourseRegistrationForm()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Add Course</button>
                <button onclick="openAssignCourseForm()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Assign Course</button>

                <!-- View and Manage Section -->
        <button onclick="showManageAdmins()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Manage Admins</button>
        <button onclick="showManageManagers()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Manage Managers</button>
        <button onclick="showManageTeachers()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Manage Teachers</button>
        <button onclick="showManageStudents()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Manage Students</button>

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


<!-- Manage Admins Section -->
<section id="manage-admins" class="hidden">
    <h3 class="text-2xl font-semibold text-gray-800">Manage Admins</h3>
    <p class="mt-4 text-gray-700">Here you can view and manage all admins.</p>
    <div class="mt-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Username</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Email</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Full Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admins as $admin)
                    <tr>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $admin->username }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $admin->email }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $admin->full_name }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $admin->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Manage Managers Section -->
<section id="manage-managers" class="hidden">
    <h3 class="text-2xl font-semibold text-gray-800">Manage Managers</h3>
    <p class="mt-4 text-gray-700">Here you can view and manage all managers.</p>
    <div class="mt-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Username</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Email</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Full Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($managers as $manager)
                    <tr>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $manager->username }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $manager->email }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $manager->full_name }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $manager->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Manage Teachers Section -->
<section id="manage-teachers" class="hidden">
    <h3 class="text-2xl font-semibold text-gray-800">Manage Teachers</h3>
    <p class="mt-4 text-gray-700">Here you can view and manage all teachers.</p>
    <div class="mt-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Username</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Email</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Full Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $teacher->username }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $teacher->email }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $teacher->full_name }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $teacher->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Manage Students Section -->
<section id="manage-students" class="hidden">
    <h3 class="text-2xl font-semibold text-gray-800">Manage Students</h3>
    <p class="mt-4 text-gray-700">Here you can view and manage all students.</p>
    <div class="mt-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Username</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Email</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Full Name</th>
                    <th class="px-4 py-2 text-left text-gray-600 border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $student->username }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $student->email }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $student->full_name }}</td>
                        <td class="px-4 py-2 text-gray-800 border-b">{{ $student->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
            document.getElementById('dashboard-content').classList.remove('hidden');
            document.getElementById('registration-form').classList.add('hidden');
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


    function showCourseRegistrationForm() {
        document.getElementById('assign-course-form').classList.add('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('course-registration-form').classList.remove('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');
        }


        function openAssignCourseForm() {
            document.getElementById('course-registration-form').classList.add('hidden');
            document.getElementById('assign-course-form').classList.remove('hidden');
            document.getElementById('dashboard-content').classList.add('hidden');
            document.getElementById('registration-form').classList.add('hidden');
            document.getElementById('manage-admins').classList.add('hidden');
            document.getElementById('manage-managers').classList.add('hidden');
            document.getElementById('manage-teachers').classList.add('hidden');
            document.getElementById('manage-students').classList.add('hidden');

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


// Functions to show and hide the corresponding sections
function showManageAdmins() {
    hideAllSections();
    document.getElementById('manage-admins').classList.remove('hidden');
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('assign-course-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
     document.getElementById('registration-form').classList.add('hidden');
}

function showManageManagers() {
    hideAllSections();
    document.getElementById('manage-managers').classList.remove('hidden');
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('assign-course-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
     document.getElementById('registration-form').classList.add('hidden');
}

function showManageTeachers() {
    hideAllSections();
    document.getElementById('manage-teachers').classList.remove('hidden');
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('assign-course-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
     document.getElementById('registration-form').classList.add('hidden');
}

function showManageStudents() {
    hideAllSections();
    document.getElementById('manage-students').classList.remove('hidden');
    document.getElementById('dashboard-content').classList.add('hidden');
    document.getElementById('assign-course-form').classList.add('hidden');
    document.getElementById('course-registration-form').classList.add('hidden');
     document.getElementById('registration-form').classList.add('hidden');
}

// Hide all sections by default
function hideAllSections() {
    document.getElementById('manage-admins').classList.add('hidden');
    document.getElementById('manage-managers').classList.add('hidden');
    document.getElementById('manage-teachers').classList.add('hidden');
    document.getElementById('manage-students').classList.add('hidden');
}

    </script>
</body>
</html>
