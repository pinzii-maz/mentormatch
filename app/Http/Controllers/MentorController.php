<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class MentorController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/RegisterMentor');
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
            'job' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'reason' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $mentorRole = Role::where('slug', 'mentor')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $mentorRole->id,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'education' => $request->education,
            'job' => $request->job,
            'expertise' => $request->expertise,
            'reason' => $request->reason,
        ]);

        if ($request->hasFile('file')) {
            $user->file = $request->file('file')->store('mentor_files', 'public');
            $user->save();
        }

        auth()->login($user);

        return redirect()->route('dashboard');
    }
}
