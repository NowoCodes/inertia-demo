<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function edit()
    {
        return inertia('Users/Edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        auth()->user()->update($request->all());

        return Redirect::route('edit-profile'); // ->with('success', 'Profile updated successfully');
    }
}
