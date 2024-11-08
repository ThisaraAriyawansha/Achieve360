<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for Stylish Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Custom styling for a more refined look */
        .heading-font {
            font-family: 'Playfair Display', serif;
        }
        .body-font {
            font-family: 'Open Sans', sans-serif;
        }
        .shadow-lg {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .text-shadow {
            text-shadow: 1px 1px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen text-gray-900 bg-gray-50 body-font">

    <!-- Loading Overlay -->
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-white bg-opacity-90" id="loadingOverlay">
        <div class="w-16 h-16 border-8 border-gray-300 rounded-full border-t-blue-600 animate-spin"></div>
    </div>

    <!-- Back Button -->
    <button class="absolute px-4 py-2 text-blue-600 transition-all transform bg-white border border-blue-600 rounded-md top-5 left-5 hover:bg-blue-600 hover:text-white hover:scale-105" onclick="goBack()">Back</button>
    <!-- Main Container -->
    <div class="flex w-full max-w-4xl overflow-hidden bg-white shadow-lg rounded-xl">
        <!-- Left Section -->
        <div class="flex flex-col items-center justify-center w-2/5 p-12 text-white bg-gradient-to-br from-blue-600 to-blue-800">
            <h1 class="mb-4 text-4xl font-semibold text-shadow heading-font">Welcome to Achieve360</h1>
            <p class="text-lg font-medium opacity-90">Log in to continue your journey</p>
        </div>

        <!-- Right Section -->
        <div class="flex-1 p-10">
            <ul class="flex justify-center mb-6 space-x-8 text-lg font-semibold text-gray-500 border-b border-gray-200">
                <li><button class="px-4 py-2 text-blue-600 border-b-2 border-blue-600 focus:outline-none">Login</button></li>
            </ul>

            <div class="mt-4">
                <!-- Login Form -->
                <h5 class="mb-8 text-2xl font-semibold text-center text-gray-800">Login to your account</h5>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-300 rounded-lg">
                        <ul class="pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Success Messages -->
                @if (session('success'))
                    <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                        <ul class="pl-5 list-disc">
                            <li>{{ session('success') }}</li>
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-6">
                        <input type="email" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="loginEmail" name="email" placeholder="Email" required>
                    </div>
                    <div class="mb-6">
                        <input type="password" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" id="loginPassword" name="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="w-full py-3 font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tailwind CSS JS (optional for dynamic functionality) -->
    <script>
        function goBack() {
            window.history.back();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            setTimeout(function() {
                loadingOverlay.style.display = 'none';
            }, 1000);
        });
    </script>
</body>

</html>
