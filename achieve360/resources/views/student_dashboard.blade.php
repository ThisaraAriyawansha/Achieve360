<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-blue-900">
            <div class="px-6 py-4 text-2xl font-semibold border-b border-blue-800">
            Student Dashboard
            </div>
            <nav class="flex-1 p-4 space-y-2 text-base">
                <a href="#" onclick="showDashboard()" class="block px-4 py-2 transition-all duration-200 bg-blue-800 rounded-lg hover:bg-blue-700">Dashboard</a>
                <button onclick="fetchCourseDetails()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Enroll</button>
                <button onclick="viewEnrolledCourses()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">
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


            </main>
        </div>
    </div>



    <script>
        function showDashboard() {
            document.getElementById('dashboard-content').classList.remove('hidden');
            document.getElementById('registration-form').classList.add('hidden');
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

    function fetchCourseDetails() {
    fetch('/get-course-details')  // Your route to fetch course details
        .then(response => response.json())
        .then(courses => {
            let courseContent = `
                <h3 class="text-2xl font-semibold text-gray-800">Course Details</h3>
                <div class="mt-4 space-y-4">
            `;

            courses.forEach(course => {
                courseContent += `
                    <div class="p-4 transition-shadow duration-200 bg-white rounded-lg shadow-md hover:shadow-lg">
                        <h4 class="text-xl font-semibold text-blue-800">${course.course_name}</h4>
                        <p class="text-gray-700"><strong>Lecturer:</strong> ${course.teacher_name}</p>
                        <p class="text-gray-700"><strong>Description:</strong> ${course.course_description}</p>
                        <button onclick="enrollInCourse('${course.course_name}', '${course.teacher_name}')" class="px-6 py-2 mt-4 text-white transition-colors duration-200 bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            Enroll
                        </button>
                    </div>
                `;
            });

            courseContent += `</div>`;
            document.getElementById('dashboard-content').innerHTML = courseContent;
        })
        .catch(error => console.error('Error fetching course details:', error));
}


function enrollInCourse(courseName, teacherName) {
    const studentEmail = '{{ session("email") }}';  // Assuming session holds email information

    if (!studentEmail) {
        alert("You must be logged in to enroll.");
        return;
    }

    const enrollmentData = {
        student_email: studentEmail,
        course_name: courseName,
        teacher_name: teacherName,
    };

    fetch('/enroll-course', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify(enrollmentData),
    })
    .then(response => response.json())  // Ensure the response is parsed as JSON
    .then(data => {
        if (data.message) {
            alert(data.message); // Show success message from the server
        } else if (data.error) {
            alert(data.error); // Show error message from the server
        } else {
            alert('Unknown error occurred');
        }
    })
    .catch(error => {
        console.error('Error enrolling in course:', error);
        alert('There was an error enrolling in the course. Please try again.');
    });
}


function viewEnrolledCourses() {
    fetch('/view-enrolled-courses', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
    .then(response => response.json())
    .then(courses => {
        let courseContent = `
            <h3 class="mb-6 text-2xl font-semibold text-gray-800">Your Enrolled Courses</h3>
            <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100">
                        <tr class="text-left">
                            <th class="px-6 py-3 text-sm font-medium text-gray-600">Course Name</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-600">Lecturer</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-600">Marks</th>
                            <th class="px-6 py-3 text-sm font-medium text-gray-600">Attendance</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        if (courses.error) {
            courseContent = `<p class="text-red-500">${courses.error}</p>`;
        } else {
            courses.forEach(course => {
                courseContent += `
                    <tr class="transition-colors duration-200 border-t hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">
                            <div class="flex items-center">
                                <!-- Course Icon using FontAwesome -->
                                <i class="mr-2 text-indigo-600 fas fa-book-open"></i>
                                ${course.course_name}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <!-- Lecturer Icon using FontAwesome -->
                                <i class="mr-2 text-green-600 fas fa-user-tie"></i>
                                ${course.teacher_name}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <!-- Marks Icon using FontAwesome -->
                                <i class="mr-2 text-yellow-500 fas fa-check-circle"></i>
                                ${course.marks}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <!-- Attendance Icon using FontAwesome -->
                                <i class="mr-2 text-purple-500 fas fa-calendar-check"></i>
                                ${course.attendance_count}
                            </div>
                        </td>
                    </tr>
                `;
            });
        }

        courseContent += `
                    </tbody>
                </table>
            </div>
        `;

        document.getElementById('dashboard-content').innerHTML = courseContent;
    })
    .catch(error => {
        console.error('Error fetching enrolled courses:', error);
        alert('There was an error fetching your enrolled courses.');
    });
}




    </script>
</body>
</html>
