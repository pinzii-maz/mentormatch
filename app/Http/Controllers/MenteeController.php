<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class MenteeController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/RegisterMentee');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => 'required|string',
            'education' => 'required|string',
        ]);

        $menteeRole = Role::where('slug', 'mentee')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $menteeRole->id,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'education' => $request->education,
        ]);

        auth()->login($user);

        return redirect()->route('dashboard');
    }
} 