<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserRole;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput($request->except('password'));
        }

        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'created_at' => new DateTime()
        ]);
        
        Auth::login($user);
        return redirect()->route('search');
    }
}
