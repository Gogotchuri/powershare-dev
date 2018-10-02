<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function edit() {
        $user = Auth::user();

        return view('admin.settings', compact('user'));
    }

    public function updatePassword(Request $request) {
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

        return redirect(route(  'admin.settings.edit'));
    }

    public function updateNotifications(Request $request) {
        $user = Auth::user();

        $notifications_value = $request->input('receive_notifications', false) === 'Yes';

        $settings = $user->settings;
        $settings->receive_notifications = $notifications_value;
        $settings->save();

        return redirect(route(  'admin.settings.edit'));
    }
}
