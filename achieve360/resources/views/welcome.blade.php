<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achieve360 - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="text-gray-800 bg-gray-100">

<header class="bg-white shadow-lg">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <!-- Logo with icon and gradient text -->
            <a href="/" class="flex items-center space-x-2 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 via-blue-600 to-indigo-600">
                <i class="fas fa-graduation-cap"></i>
                <span class="font-serif">Achieve360</span>
            </a>
            <nav class="hidden space-x-6 md:flex">
                <a href="#home" class="text-gray-600 hover:text-blue-600">Home</a>
                <a href="#about" class="text-gray-600 hover:text-blue-600">About</a>
                <a href="#courses" class="text-gray-600 hover:text-blue-600">Courses</a>
                <a href="#contact" class="text-gray-600 hover:text-blue-600">Contact</a>
            </nav>
            <div class="flex space-x-4">
                <a href="/login" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-md hover:bg-blue-700">Log In</a>
                <a href="/register" class="px-4 py-2 text-sm text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white">Sign Up</a>
            </div>
        </div>
    </header>

<!-- Hero Section -->
<section id="home" class="relative flex flex-col items-center justify-center h-screen text-white">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-center bg-cover" style="background-image: url('https://social-hire.com/uploads/38760-16311844_rm373batch13-081.jpg');"></div>
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-transparents to-indigo-700 opacity-70"></div>
    
    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center p-6 -mt-20 bg-black bg-opacity-0 rounded-md">
    <h1 class="mb-4 text-5xl font-bold">Welcome to <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-white">Achieve360</span></h1>
    <p class="max-w-2xl mb-8 text-lg text-center">
        Unlock your potential with our comprehensive learning platform. Dive into courses, track your progress, and achieve your goals with ease.
    </p>
    <div class="flex space-x-6">
        <a href="#courses" class="px-6 py-3 font-semibold text-blue-600 bg-white rounded-md hover:bg-gray-200">Explore Courses</a>
        <a href="/register" class="px-6 py-3 font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800">Get Started</a>
    </div>
</div>

</section>



    <!-- About Section -->
    <section id="about" class="py-20 text-center bg-gray-100">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600"><i class="mr-2 fas fa-bullseye"></i>About Achieve360</h2>
            <p class="max-w-2xl mx-auto text-gray-700">
                Achieve360 is designed to make learning accessible, engaging, and effective. We offer a variety of courses across multiple fields, allowing you to learn at your own pace and track your journey towards mastery.
            </p>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-20 text-center bg-white">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600"><i class="mr-2 fas fa-graduation-cap"></i>Popular Courses</h2>
            <p class="max-w-2xl mx-auto mb-10 text-gray-700">
                Explore our most popular courses and start learning today!
            </p>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold"><i class="mr-2 fas fa-laptop-code"></i>Web Development</h3>
                    <p class="text-gray-600">Learn the fundamentals of web development, from HTML & CSS to JavaScript.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold"><i class="mr-2 fas fa-database"></i>Data Science</h3>
                    <p class="text-gray-600">Master data science concepts and techniques with real-world applications.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold"><i class="mr-2 fas fa-bullhorn"></i>Digital Marketing</h3>
                    <p class="text-gray-600">Gain insights into digital marketing strategies and grow your brand online.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 text-center bg-gray-100">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600"><i class="mr-2 fas fa-headset"></i>Contact Us</h2>
            <p class="max-w-2xl mx-auto mb-8 text-gray-700">
                Have questions or need support? Reach out to us, and we'll be happy to help.
            </p>
            <a href="mailto:support@achieve360.com" class="px-6 py-3 font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">Email Us</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 text-white bg-gray-800">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Achieve360. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
