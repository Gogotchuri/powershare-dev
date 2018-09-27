<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function edit() {
        $user = Auth::user();

        return view('user.settings', compact('user'));
    }

    public function update(Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'current_password' => 'required|min:6',
            'password' => 'required|confirmed|min:6',
        ]);

        // TODO: Add following validation to above to not return errors separately when both checks fail
        $currentPassword = $request->input('current_password');

        if(!Hash::check($currentPassword, $user->getAuthPassword())) {
            return back()->withErrors(['current_password' => ['Did not match your current password']]);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect(route(  'user.settings.edit'));
    }
}
