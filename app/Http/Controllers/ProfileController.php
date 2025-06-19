<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Drivers\Gd\Driver;
use App\Http\Requests\ProfileUpdateRequest;
use DragonCode\Support\Facades\Helpers\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui.');
    }

    /**
     * Update the user's avatar.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        // Validasi file yang diupload
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil file yang diupload
        $file = $request->file('avatar');
        $filename = 'avatar_' . Str::random(5);
        $path = 'app/private/avatars/';
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file);
        $image->resize(250, 250);
        $encoded = $image->toPng();
        $encoded->save(storage_path($path . $filename . '.png'));

        $user_id = $request->user()->id;
        User::where('id', $user_id)->update([
            'avatar' => $filename . '.png',
        ]);

        return redirect()->back()->with('success', 'Avatar berhasil diperbarui.');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
