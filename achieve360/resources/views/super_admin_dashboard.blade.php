<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="flex flex-col w-64 text-white bg-blue-800">
            <div class="px-6 py-4 text-2xl font-semibold border-b border-blue-700">
                Super Admin
            </div>
            <nav class="flex-1 p-4 space-y-2 text-base">
                <a href="#" class="block px-4 py-2 bg-blue-700 rounded-lg hover:bg-blue-600">Dashboard</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-600">Users</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-600">Reports</a>
                <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-600">Settings</a>
                <a href="#" class="block px-4 py-2 mt-4 text-center bg-red-600 rounded-lg hover:bg-red-500">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Navbar -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-blue-600 bg-white border border-blue-600 rounded-lg hover:bg-blue-100">
                        Notifications
                    </button>
                    <button class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Add User
                    </button>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gray-100">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                        <p class="mt-2 text-3xl font-bold text-blue-600">1,234</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Active Sessions</h3>
                        <p class="mt-2 text-3xl font-bold text-blue-600">432</p>
                    </div>
                    <div class="p-4 bg-white rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Monthly Revenue</h3>
                        <p class="mt-2 text-3xl font-bold text-blue-600">$15,000</p>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-hidden bg-white rounded-lg shadow">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">User</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-700">John Doe</td>
                                <td class="px-6 py-4 text-gray-500">john@example.com</td>
                                <td class="px-6 py-4 text-green-600">Active</td>
                                <td class="px-6 py-4">
                                    <button class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">Edit</button>
                                    <button class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                                </td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-700">Jane Smith</td>
                                <td class="px-6 py-4 text-gray-500">jane@example.com</td>
                                <td class="px-6 py-4 text-yellow-600">Pending</td>
                                <td class="px-6 py-4">
                                    <button class="px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700">Edit</button>
                                    <button class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700">Delete</button>
                                </td>
                            </tr>
                            <!-- More rows as needed -->
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>

</html>
