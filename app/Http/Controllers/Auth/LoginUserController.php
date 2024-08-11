<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class LoginUserController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('auth.login');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'email' => ['required','email','lowercase','max:150'],
            'password' => ['required', Password::default()],
        ]);

        if (! Auth::attempt($attributes, $request->remember))
        {
            throw ValidationException::withMessages([
                'email' => 'Sorry those credentials dose not match.'
            ]);
        }

        $request->session()->regenerate();

        return to_route('notes')->with('success','Login successful.');
    }

    public function destroy(): RedirectResponse
    {
        Auth::guard('web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return to_route('login');
    }
}
