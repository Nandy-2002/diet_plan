@extends('layouts.app')

@section('scripts')
<script>
    document.getElementById('userForm').addEventListener('submit', function(event) {
        var phone = document.getElementById('phone').value;
        var phoneError = document.getElementById('phoneError');

        // Check if phone number is exactly 10 digits
        if (!/^\d{10}$/.test(phone)) {
            event.preventDefault(); // Stop form submission
            phoneError.classList.remove('hidden'); // Show error message
        } else {
            phoneError.classList.add('hidden'); // Hide error message
        }

        // Existing password matching validation
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;
        var passwordError = document.getElementById('passwordError');

        // Check if passwords match
        if (password !== confirmPassword) {
            event.preventDefault(); // Stop form submission
            passwordError.classList.remove('hidden'); // Show error message
        } else {
            passwordError.classList.add('hidden'); // Hide error message
        }
    });

    // Clear the error message when typing
    document.getElementById('password_confirmation').addEventListener('input', function() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;
        var passwordError = document.getElementById('passwordError');

        if (password === confirmPassword) {
            passwordError.classList.add('hidden'); // Hide error message
        }
    });
</script>
@endsection

@section('content')
<div class="p-4">
    <div class="flex items-center justify-between pt-4">
        <h2 class="text-lg text-white font-semibold mb-0">Edit User</h2>
        <a href="{{ route('admin.users') }}" class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2">
            Back to Users
        </a>
    </div>
</div>
<div class="container mx-auto px-4 py-6">
    <form id="userForm" action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                    Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required>
            </div>
    
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    placeholder="name@example.com" required>
            </div>
    
            <!-- Password Field -->
            <div class="password-field mb-3">
                <label for="password" class="form-label text-sm font-medium text-gray-900 dark:text-white">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" 
                        class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <button type="button" onclick="togglePasswordVisibility(this)"
                        class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
                <p class="text-gray-400 text-sm pt-2">If you want to update, enter your password; otherwise, leave it blank.</p>
            </div>
            
            <!-- Confirm Password Field -->
            <div class="password-field mb-3">
                <label for="password_confirmation" class="form-label text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                        class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <button type="button" onclick="togglePasswordVisibility(this)"
                        class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-eye-slash"></i>
                    </button>
                </div>
                <p id="passwordError" class="text-red-500 text-sm hidden">Passwords do not match.</p>
            </div>
    
            <!-- Phone Number Field (Optional) -->
            <div class="mb-3">
                <label for="phone" pattern="\d{10}"  class="form-label text-sm font-medium text-gray-900 dark:text-white">
                    Phone Number
                </label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                <p id="phoneError" class="text-red-500 text-sm hidden">Phone number must be 10 digits.</p>
            </div>
    
            <!-- Address Field (Optional) -->
            <div class="mb-3">
                <label for="address" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                    Address
                </label>
                <textarea name="address" id="address"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">{{ old('address', $user->address) }}</textarea>
            </div>
    
            <!-- Role Field -->
            <div class="mb-3">
                <label for="role" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                    Role <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role"
                    class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    >
                        <option value="">Select Role</option>
                        <option value="1">Admin</option>
                        <option value="0">User</option>
                </select>
            </div>
        </div>
    
        <button type="submit"
            class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 mt-4">
            Update User
        </button>
    </form>    
</div>
@endsection