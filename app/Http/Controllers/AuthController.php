<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure this view exists in resources/views/auth/login.blade.php
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the login credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Redirect to the intended location or dashboard
            return redirect()->intended(route('dashboard'));
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function showRegistrationForm()
    {
        // Read the CSV file
        $diseaseNutrition = $this->readCsv(storage_path('app/public/disease_nutrition.csv'));

        // Extract disease names from the second row (assuming the second column contains the disease names)
        $diseaseNames = [];
        foreach ($diseaseNutrition as $row) {
            // Assuming the disease name is in the second column (index 1)
            if (isset($row[1]) && !empty($row[1])) {
                $diseaseNames[] = $row[1];
            }
        }

        return view('auth.register', compact('diseaseNames')); // Ensure this view exists in resources/views/auth/register.blade.php
    }

    public function readCsv($filePath)
    {
        $data = [];

        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                $data[] = $row;
            }
            fclose($handle);
        }

        return $data;
    }

    // Handle the registration request
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'disease_name' => 'nullable|string|max:255',
        ]);

        // Create a new user and save to the database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
            'dob' => $validatedData['dob'],
            'gender' => $validatedData['gender'],
            'disease_name' => $validatedData['disease_name'],
            'role_id' => 2,  // Assuming role_id 2 is for a regular user
        ]);

        // Redirect or return a response after successful registration
        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    // Handle the logout request
    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out

        // Redirect to the login page
        return redirect()->route('landing')->with('success', 'Successfully logged out.');
    }
}