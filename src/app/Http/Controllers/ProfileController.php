<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RootController;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use App\Models\Review;
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
    public function show_other($id)
    {
        $intId = (int)$id;
        $loggedInUserId = auth()->id();

        //ログインしているユーザーがゲスト、またはルーティング先のユーザーページと同じユーザーである
        if($intId === $loggedInUserId || null === $loggedInUserId){
           return redirect()->route('dashboard');           
        }
        $userData = User::find($id);
        $userReviews = Review::getUserReviews($id);

        return view('/profile/otheruser',[
            'user_data' => $userData,
            'user_reviws' => $userReviews
        ]);
    }


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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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
