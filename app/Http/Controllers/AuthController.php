<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('dashboard');
            }

            return redirect()->back()->withInput()->withErrors(['email' => 'Invalid email or password']);
        } catch (ValidationException $e) {
            Log::error('Validation error during login: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['email' => 'Validation error during login']);
        } catch (\Exception $e) {
            Log::error('Error during login: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['email' => 'Error during login']);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            return redirect('/');
        } catch (\Exception $e) {
            Log::error('Error during logout: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Error during logout']);
        }
    }
}
