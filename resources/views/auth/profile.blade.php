<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-900 text-gray-200">
    <div class="container mx-auto mt-10 p-2">
        <div class="flex justify-between align-center mb-2">
            <h1 class="text-3xl font-bold mb-6">Edit Profile</h1>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Logout</button>
            </form>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">{{ session('error') }}</div>
        @endif

        <div class="bg-gray-800 rounded-lg shadow-md mb-4">
            <div class="text-sm font-medium text-center text-gray-500 border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#" onclick="showTab('profileTab')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-400 hover:border-gray-600 dark:hover:text-gray-300">Profile</a>
                    </li>
                    <li class="me-2">
                        <a href="#" onclick="showTab('passwordTab')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-400 hover:border-gray-600 dark:hover:text-gray-300">Change
                            Password</a>
                    </li>
                    <li class="me-2">
                        <a href="#" onclick="showTab('browserSessionsTab')"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-400 hover:border-gray-600">Browser
                            Sessions</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg shadow-md p-4">
            <div id="profileTab" class="tab-content">
                <h2 class="text-xl font-semibold mb-4">Update Profile</h2>
                <form action="{{ route('update') }}" method="POST" class="mb-6">
                    @csrf
                    @method('put')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-300">Name</label>
                        <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" autofocus
                            autocomplete="off"
                            class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-300">Email</label>
                        <input type="text" id="email" name="email" value="{{ auth()->user()->email }}"
                            autofocus autocomplete="off"
                            class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="logout_other_devices" id="logout_other_devices"
                            {{ auth()->user()->logout_other_devices ? 'checked' : '' }}>
                        <label for="logout_other_devices" class="block text-gray-300 ml-1">Logout from other devices
                            when login</label>
                        @error('logout_other_devices')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
                </form>
            </div>

            <div id="passwordTab" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4">Change Password</h2>
                <form action="{{ url('change-password') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="current_password" class="block text-gray-300">Current Password</label>
                        <input type="password" id="current_password" name="current_password" autofocus
                            autocomplete="current-password"
                            class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('current_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password" class="block text-gray-300">New Password</label>
                        <input type="password" id="new_password" name="new_password" autofocus
                            autocomplete="new-password"
                            class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('new_password')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="block text-gray-300">Confirm New
                            Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="w-full p-3 rounded bg-gray-700 text-gray-100 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Change Password</button>
                </form>
            </div>
            <div id="browserSessionsTab" class="tab-content hidden">
                <h2 class="text-xl font-semibold mb-4 text-white">Browser Sessions</h2>
                {{-- Desktop --}}
                @foreach (auth()->user()->sessions()->orderBy('last_activity', 'desc')->get() as $session)
                    <div
                        class="flex items-center justify-between p-3 bg-gray-800 rounded-lg border border-gray-700 mb-4">
                        <div class="flex items-center">
                            <i
                                class="fas fa-{{ $session->user_agent['is_desktop'] ? 'desktop' : 'mobile-alt' }} w-6 h-6 text-gray-200 mr-3"></i>
                            <div>
                                <div class="font-semibold text-white">
                                    {{ $session->user_agent['platform'] }} - {{ $session->user_agent['browser'] }}
                                </div>
                                <div class="text-sm text-gray-400">
                                    {{ $session->ip_address }} @if ($session->is_this_device)
                                        <span class="text-green-500">This device</span>
                                    @endif
                                </div>
                                <div class="text-xs text-gray-500">Last Active {{ $session->last_activity }}</div>
                            </div>
                        </div>
                        @if (!$session->is_this_device)
                            <form action="{{ route('logout_device', $session) }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded-md">Logout</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>


        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const activeTab = localStorage.getItem('activeTab') || 'profileTab';
            showTab(activeTab);
        });

        function showTab(tabId) {
            const tabs = document.querySelectorAll('.tab-content');
            tabs.forEach(tab => {
                tab.classList.add('hidden');
            });
            const activeTabLink = document.querySelectorAll('a');
            activeTabLink.forEach(link => {
                link.classList.remove('border-blue-500', 'text-blue-500');
            });
            document.getElementById(tabId).classList.remove('hidden');
            const activeLink = document.querySelector(`a[onclick="showTab('${tabId}')"]`);
            activeLink.classList.add('border-blue-500', 'text-blue-500');
            localStorage.setItem('activeTab', tabId);
        }
    </script>
</body>

</html>
