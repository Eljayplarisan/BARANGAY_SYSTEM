<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ResidentProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('resident.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $user = $request->user();
        $user->name = $validated['name'];

        if ($request->hasFile('profile_photo')) {
            $oldPhoto = $user->profile_photo_path;
            $user->profile_photo_path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->save();

            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            $user->save();
        }

        return back()->with('status', 'Your profile has been updated.');
    }
}
