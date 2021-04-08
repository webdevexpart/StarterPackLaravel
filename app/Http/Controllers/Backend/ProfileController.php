<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.Auth::id(),
            'avatar' => 'nullable|image'
        ]);


        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        notify()->success('User Profile Updated.', 'Success');
        return back();
    }

    public function changePassword()
    {
        return view('backend.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'password' => 'required|confirmed|string|min:8'
        ]);
        $user = Auth::user();
        $hasedPassword = $user->password;
        if (Hash::check($request->current_password, $hasedPassword)) {
            if (!Hash::check($request->password, $hasedPassword)) {
                $user->update([
                   'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                return redirect()->route('login');
            } else {
                notify()->warning('New password cont not be same as old password', 'Warning');
            }
        } else {
            notify()->error('Current password not match', 'Error');
        }

        return back();
    }
}
