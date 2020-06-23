<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AuthController\LoginRequest;
use App\Http\Requests\Backend\AuthController\PasswortResetRequest;
use App\Http\Requests\Backend\AuthController\RequestPasswortResetRequest;
use App\Mail\Backend\Admins\Notification;
use App\Mail\Backend\Admins\ResetPassword;
use App\Models\Admins\Admin;
use App\Models\Admins\Group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(LoginRequest $request) {

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => true])) {

            return Redirect::route('get.dashboard');

        }

        // TODO: Change to Language Key
        throw ValidationException::withMessages([
            'email' => ['Die eingegebenen Zugangsdaten sind nicht korrekt.'],
        ]);

    }

    public function logout() {

        Auth::logout();

        return Redirect::route('login');

    }

    public function passwordReset(PasswortResetRequest $request) {

        if(Cache::has('resetpassword:' . $request->adminid) && Cache::get('resetpassword:' . $request->adminid) == $request->token) {

            $admin = Admin::find($request->adminid);

            $admin->password = $request->password;
            $admin->save();

            Cache::forget('resetpassword:', $admin->admin_id);

            $group = Group::find($admin->group_id);

            $title = "Ein Nutzer in deiner Gruppe hat sein Passwort geändert.";
            $desc = "Der Nutzer " . $admin->name . " hat soebene sein Passwort für Scannel geändert.";

            Mail::to(Admin::find($group->supervisor_id))->send(new Notification($title, $desc));

            // TODO: Change to language Key
            return Redirect::route('login')->with('success', 'Ihr Passwort wurde erfolgreich geändert!');

        }

        return Redirect::back()->withErrors();

    }

    public function requestPasswordReset(RequestPasswortResetRequest $request) {

        if ($admin = Admin::where('email', $request->email)->first()) {


            $token = Str::random(16);

            Cache::put('resetpassword:' . $admin->admin_id, $token);

            Mail::to($admin)->send(new ResetPassword($admin, $token));

        }

        // TODO: Change to Language Key
        return Redirect::back()->with('success', 'E-Mail Versendet');

    }

}
