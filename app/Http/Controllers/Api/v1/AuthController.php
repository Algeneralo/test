<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Mail\AppUsers\VerifyEmail;
use App\Models\Counter;
use App\Models\Scannel\AppUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(UserRegisterRequest $userRegisterRequest)
    {

        $newUser = new AppUser;

        $newUser->email = $userRegisterRequest->input('email');
        $newUser->password = Hash::make($userRegisterRequest->input('password'));
        $newUser->scannelid = $this->generateScannelId($userRegisterRequest->input('country'));

        $newUser->save();


        Mail::to($newUser)->locale(App::getLocale())->send(new VerifyEmail($newUser));

        return response()->json([
            'data' => [
                'msg' => __('success-messages.register-success')
            ]
        ]);


    }

    public function login(UserLoginRequest $userLoginRequest)
    {

        $user = AppUser::where('email', $userLoginRequest->loginValue)->orWhere('scannelid', $userLoginRequest->loginValue)->first();

        if (!$user || !Hash::check($userLoginRequest->password, $user->password) || ($user->email_verified_at == null)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'data' => [
                'token' => $user->createToken('api')->plainTextToken,
                'hasProfile' => $user->profiles()->count()
            ]
        ]);

    }

    public function check() {

        return response()->json([
           'data' => [
               'msg' => 'You are already signed in.'
           ]
        ]);

    }

    public function verifyEmail($lang, $scannelid, $email)
    {

        App::setLocale($lang);

        try {

            $user = AppUser::where('scannelid', $scannelid)->firstOrFail();

            // TODO: Change to Boolean

            $user->email_verified_at = now();
            $user->save();

            return view('web.verify-email')->with([
                'user' => $user
            ]);


        } catch (ModelNotFoundException $e) {


        }


    }

    private function generateScannelId($country)
    {

        $scannelID = $country . Counter::getCounter('scannelid')->incrementCounter();

        return $scannelID;

    }

}
