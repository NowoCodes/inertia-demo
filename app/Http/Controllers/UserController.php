<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Intervention\Image\Facades\Image;
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

    public function update(UserRequest $request): RedirectResponse
    {
        $user = auth()->user();

        $user->update($request->all());

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(100, 100)->save(public_path('storage/' . $filename));
            $user->image = $filename;
            $user->save();
        }

        return Redirect::route('edit-profile'); // ->with('success', 'Profile updated successfully');
    }
}
