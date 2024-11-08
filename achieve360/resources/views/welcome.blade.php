<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achieve360 - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="text-gray-800 bg-gray-100">

    <!-- Navbar -->
    <header class="bg-white shadow-lg">
        <div class="container flex items-center justify-between px-6 py-4 mx-auto">
            <a href="/" class="text-3xl font-bold text-blue-600">Achieve360</a>
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
    <section id="home" class="flex flex-col items-center justify-center h-screen text-white bg-blue-600">
        <h1 class="mb-4 text-5xl font-bold">Welcome to Achieve360</h1>
        <p class="max-w-2xl mb-8 text-lg text-center">
            Unlock your potential with our comprehensive learning platform. Dive into courses, track your progress, and achieve your goals with ease.
        </p>
        <div class="flex space-x-6">
            <a href="#courses" class="px-6 py-3 font-semibold text-blue-600 bg-white rounded-md hover:bg-gray-200">Explore Courses</a>
            <a href="/register" class="px-6 py-3 font-semibold text-white bg-blue-700 rounded-md hover:bg-blue-800">Get Started</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 text-center bg-gray-100">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600">About Achieve360</h2>
            <p class="max-w-2xl mx-auto text-gray-700">
                Achieve360 is designed to make learning accessible, engaging, and effective. We offer a variety of courses across multiple fields, allowing you to learn at your own pace and track your journey towards mastery.
            </p>
        </div>
    </section>

    <!-- Courses Section -->
    <section id="courses" class="py-20 text-center bg-white">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600">Popular Courses</h2>
            <p class="max-w-2xl mx-auto mb-10 text-gray-700">
                Explore our most popular courses and start learning today!
            </p>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold">Web Development</h3>
                    <p class="text-gray-600">Learn the fundamentals of web development, from HTML & CSS to JavaScript.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold">Data Science</h3>
                    <p class="text-gray-600">Master data science concepts and techniques with real-world applications.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-lg">
                    <h3 class="mb-2 text-xl font-semibold">Digital Marketing</h3>
                    <p class="text-gray-600">Gain insights into digital marketing strategies and grow your brand online.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 text-center bg-gray-100">
        <div class="container mx-auto">
            <h2 class="mb-4 text-3xl font-bold text-blue-600">Contact Us</h2>
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
