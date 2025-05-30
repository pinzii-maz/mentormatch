<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class RegisterMentorController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Auth/RegisterMentor');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)],
            'gender' => 'required|string',
            'education' => 'required|string',
            'job' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'reason' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('mentor_files', 'public');
        }

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'gender' => $data['gender'],
            'education' => $data['education'],
            'job' => $data['job'],
            'expertise' => $data['expertise'],
            'reason' => $data['reason'],
            'file_path' => $filePath,
            'role' => 'mentor',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
} 