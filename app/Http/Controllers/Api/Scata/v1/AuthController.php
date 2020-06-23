<?php

namespace App\Http\Controllers\Api\Scata\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Scata\v1\User;
use App\Models\Admins\Admin;
use App\Models\Scannel\AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function login(Request $request) {

        $admin = Admin::where('email', $request->loginValue)->orWhere('admin_id', $request->loginValue)->first();

        if (!$admin || !Hash::check($request->password, $admin->password) || ($admin->status == false)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return User::make($admin)->additional([
            'data' => [
                'token' => $admin->createToken('api')->plainTextToken
            ]
        ]);

    }

    public function check() {

        return User::make(Auth::user());

    }

}
