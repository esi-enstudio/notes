<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'name' => ['required','min:3','max:150','string'],
            'email' => ['required','email','lowercase','max:150','unique:'.User::class],
            'password' => ['required', 'confirmed', Password::default()],
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return to_route('notes')->with('success','User '. $user->name.' created and login successfully.');
    }
}
