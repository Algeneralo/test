<?php

namespace App\Http\Controllers\Backend;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\AppUserController\CreateUserRequest;
use App\Http\Requests\Backend\AppUserController\PasswortResetRequest;
use App\Http\Requests\Backend\AppUserController\UpdateRequest;
use App\Mail\AppUsers\NewAccount;
use App\Mail\VerifyEmail;
use App\Models\Counter;
use App\Models\Scannel\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class AppUsersController extends Controller
{
    public function __construct()
    {
        HelpDisk::checkIfExists("app_users");
    }

    public function users()
    {

        $users = AppUser::with('profiles')->get();

        return view('backend.app-users.users')->with([
            'users' => $users,
        ]);

    }

    public function user(AppUser $user)
    {

        return view('backend.app-users.edit')->with([
            'user' => $user,
        ]);

    }

    public function getCreate()
    {

        return view('backend.app-users.create');

    }

    public function updateUser(AppUser $user, UpdateRequest $request)
    {

        // TODO: Send E-Mail if User was activated successfully
        // TODO: Send E-Mail if E-Mail Address has been changed

        if ($request->input('active')) {

            $emailVerified = now();

        } else {
            $emailVerified = null;
        }

        $user->update([
            'email_verified_at' => $emailVerified,
            'email' => $request->email,
            'scannelid' => $request->scannelid,
        ]);

        return Redirect::back();

    }

    public function createUser(CreateUserRequest $request)
    {

        $newUser = new AppUser;

        $newUser->email = $request->input('email');
        $newUser->scannelid = $this->generateScannelId($request->input('country'));

        if ($request->input('send-credentials')) {

            $newUser->password = Str::random(32);
            $newUser->save();

            $token = Str::random(16);

            Cache::put('resetpasswordapp:' . $newUser->id, $token);

            Mail::to($newUser)->send(new NewAccount($newUser, $token));

        } else {

            $newUser->password = Hash::make($request->password);
            $newUser->save();

        }

        $newUser->markEmailAsVerified();

        return Redirect::back();

    }

    public function resetPassword(PasswortResetRequest $request)
    {

        if (Cache::has('resetpasswordapp:' . $request->appuserid) && Cache::get('resetpasswordapp:' . $request->appuserid) == $request->token) {

            $appuser = AppUser::find($request->appuserid);

            $appuser->password = Hash::make($request->password);
            $appuser->save();

            Cache::forget('resetpasswordapp:', $appuser->id);

            // TODO: Change to language Key
            return Redirect::back()->with('success', 'Dein Passwort wurde erfolgreich geändert! Du kannst dich jetzt in der Scannel App anmelden.');

        }

        return Redirect::back()->withErrors();

    }

    public function createProfile()
    {

    }

    public function updateProfile()
    {

    }

    public function softDelete(AppUser $user, Request $request)
    {

        $user->profiles()->forceDelete();
        $user->forceDelete();

        return Redirect::back();

    }

    private function generateScannelId($country)
    {

        $scannelID = $country . Counter::getCounter('scannelid')->incrementCounter();

        return $scannelID;

    }

}
