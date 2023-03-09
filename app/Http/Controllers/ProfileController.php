<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => ['required'],
            'nik' => ['required', 'numeric'],
            'telp' => ['required', 'numeric'],
        ]);


        $user = User::findOrFail(auth()->user()->id);

        if ($request->username != $user->username) {
            $this->validate($request, [
                'username' => ['unique:users,username']
            ]);
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->nik = $request->nik;
        $user->telp = $request->telp;
        $user->save();

        if (!$user) return die();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
