<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <!-- Container -->
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">

        <!-- Left column (Login Form) -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-700 text-center md:text-left">Login</h2>

            @if (session('error'))
                <div id="error-alert"
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>

                <script>
                    setTimeout(function() {
                        const alert = document.getElementById('error-alert');
                        if (alert) {
                            alert.style.display = 'none';

                            setTimeout(function() {
                                alert.remove();
                            }, 3000);
                        }
                    }, 3000);
                </script>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-600 mb-2 font-semibold ">Email</label>
                    <input type="email" name="email" placeholder="Enter email"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Password -->
                <div class="mb-6 relative">
                    <label class="block text-gray-600 mb-2 font-semibold">Password</label>
                    <input id="password" type="password" name="password" placeholder="Enter password"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />
                    <span onclick="togglePassword()"
                        class="absolute right-3 top-9 cursor-pointer text-gray-500 text-sm">
                        Show
                    </span>
                </div>

                <!-- Button -->
                <button type="submit"
                    class="w-full bg-[#1d3577]  text-white py-2 rounded-lg hover:bg-blue-600 transition">
                    Login
                </button>
            </form>
        </div>

        <!-- Right column (Logo / Branding) -->
        <div class="hidden md:flex w-1/2 bg-[#1d3577]  opacity-80 items-center justify-center">
            <div class="text-center text-white p-6">
                <img src="img/logo.png" alt="Logo" class="w-50 mx-auto mb-4" />
                <h2 class="text-2xl font-bold">Inventory System</h2>

            </div>
        </div>

    </div>

    <!-- Script -->
    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>
