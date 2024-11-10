<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                <button onclick="openRoleSelectionModal()" class="block w-full px-4 py-2 mt-4 text-center transition-all duration-200 bg-blue-700 rounded-lg hover:bg-blue-600">Register</button>
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
            document.getElementById('registration-form').classList.remove('hidden');
            document.getElementById('form-title').textContent = `Register New ${role}`;
            document.getElementById('role').value = role;

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
    </script>
</body>
</html>