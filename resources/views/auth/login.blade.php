<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg dark:border dark:border-gray-700 dark:bg-gray-800"> <!-- Changed max-w-sm to max-w-md -->
            <div class="p-6 space-y-6">
                <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white text-center">
                    Login
                </h1>
                <form class="space-y-6" action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" placeholder="name@company.com" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" required autocomplete="username">
                    </div>
                    <div class="pb-4">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <div class="password-field relative">
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 pr-10 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                   autocomplete="current-password" required>
                            <button type="button" onclick="togglePasswordVisibility(this)"
                                    class="absolute right-3 top-1/2 transform -translate-y-1/2 px-2 py-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>                        
                        @if ($errors->any())
                            <div class="text-sm text-red-600">{{ $errors->first() }}</div>
                        @endif
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Login
                    </button>

                    <p>If you don't having account <a href="{{ route('register') }}">resister</a> ?</p>
                </form>                
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility(button) {
            const passwordInput = button.previousElementSibling;
            const toggleIcon = button.querySelector('i');
    
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye'); // Change to eye icon
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash'); // Change to eye-slash icon
            }
        }
    </script>
</body>
</html>