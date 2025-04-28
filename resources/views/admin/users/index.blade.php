@extends('layouts.app')

@section('title', 'Home Page')

@section('scripts')
<!-- JavaScript for Password Validation -->
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
<script>
    function confirmDelete(form) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Submit the form if confirmed
            }
        });
    }
</script>
@endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="pb-4">
        <div class="card p-4 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h1 class="pb-4 pt-4 text-2xl dark:text-white font-semibold mb-4">Manage Users</h1>
    
            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif
    
            <form action="{{ route('admin.users.add') }}" method="POST" class="mb-6" id="userForm">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="name" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" 
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            required>
                    </div>
            
                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" 
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="name@example.com" required>
                    </div>
            
                    <!-- Password Field -->
                    <div class="password-field mb-3">
                        <label for="password" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required>
                            <button type="button" onclick="togglePasswordVisibility(this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                        <p id="passwordError" class="text-red-500 text-sm hidden">Passwords do not match.</p>
                    </div>
    
                    <!-- Confirm Password Field -->
                    <div class="password-field mb-3">
                        <label for="password_confirmation" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Confirm Password <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required>
                            <button type="button" onclick="togglePasswordVisibility(this)"
                                class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fas fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>
            
                    <!-- Phone Number Field (Optional) -->
                    <div class="mb-3">
                        <label for="phone" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Phone Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="phone" id="phone" 
                            pattern="\d{10}" 
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Enter 10-digit phone number" 
                            required>
                        <p class="text-red-500 text-sm hidden" id="phoneError">Phone number must be 10 digits.</p>
                    </div>                
            
                    <!-- Address Field (Optional) -->
                    <div class="mb-3">
                        <label for="address" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Address
                        </label>
                        <textarea name="address" id="address" 
                            class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"></textarea>
                    </div>
            
                    <!-- Role Field -->
                    <div class="mb-3">
                        <label for="role" class="form-label text-sm font-medium text-gray-900 dark:text-white">
                            Role <span class="text-red-500">*</span>
                        </label>
                        <select name="role" id="role" 
                                class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                                required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                </div>
            
                <button type="submit" 
                    class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-800 mt-4">
                    Add User
                </button>
            </form>
        </div>
    </div>
    <div class="card p-4 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="pt-4">
            <div class="mb-4 flex justify-between items-center">
                <!-- "Entries per page" dropdown -->
                <div>
                    <label class="text-sm text-gray-600">Show 
                        <select name="myTable_length" aria-controls="myTable"
                                class="rounded border-gray-300 focus:border-purple-500 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select> 
                        entries
                    </label>
                </div>
            </div>

            <!-- Scrollable table container -->
            <div class="overflow-x-auto">
                <div class="overflow-x-auto custom-scrollbar shadow-md mb-4 rounded-lg border border-gray-300 dark:border-gray-600">
                    <table id="myTable" class="min-w-full bg-white table-auto border-collapse rounded-lg shadow dark:bg-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-700 dark:text-gray-300 uppercase">Name</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-700 dark:text-gray-300 uppercase">Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-700 dark:text-gray-300 uppercase">Phone Number</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-700 dark:text-gray-300 uppercase">Address</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider text-gray-700 dark:text-gray-300 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-300">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->phone }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('admin.users.edit', $user) }}" method="GET" class="inline">
                                            <button
                                                type="submit"
                                                class="flex items-center justify-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-full active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                                                aria-label="Edit"
                                            >
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.users.delete', $user) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="flex items-center justify-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-full active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                                aria-label="Delete"
                                                onclick="event.preventDefault(); confirmDelete(this.form);"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>                                    
                                    </div>
                                </td>                            
                            </tr>
                            @endforeach
                        </tbody>                    
                    </table>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection