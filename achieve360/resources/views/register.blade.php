<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for Stylish Typography -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        .body-font {
            font-family: 'Open Sans', sans-serif;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen text-gray-900 bg-gray-50 body-font">

    <!-- Registration Form Container -->
    <div class="flex w-full max-w-md p-10 bg-white shadow-lg rounded-xl">
        <div class="w-full">
            <h1 class="mb-6 text-3xl font-semibold text-center text-gray-800">Create an Account</h1>

            <!-- Error Messages (if any) -->
            @if ($errors->any())
                <div class="p-4 mb-6 text-red-800 bg-red-100 border border-red-300 rounded-lg">
                    <ul class="pl-5 list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Messages (if any) -->
            @if (session('success'))
                <div class="p-4 mb-6 text-green-800 bg-green-100 border border-green-300 rounded-lg">
                    <ul class="pl-5 list-disc">
                        <li>{{ session('success') }}</li>
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-6">
        <input type="text" name="username" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Username" required>
    </div>
    <div class="mb-6">
        <input type="email" name="email" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Email" required>
    </div>
    <div class="mb-6">
        <input type="password" name="password" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Password" required>
    </div>
    <div class="mb-6">
        <input type="password" name="password_confirmation" class="w-full p-4 text-base transition-all border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirm Password" required>
    </div>

    <button type="submit" class="w-full py-3 font-medium text-white transition-all bg-blue-600 rounded-lg hover:bg-blue-700">Register</button>
</form>



            <!-- Link to Login -->
            <p class="mt-4 text-sm text-center text-gray-600">Already have an account? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a></p>
        </div>
    </div>

</body>

</html>
