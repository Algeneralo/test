<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserProfileRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\Scannel\User as UserResource;
use App\Models\Scannel\ExclusionCosmeticUser;
use App\Models\Scannel\ExclusionFoodUser;
use App\Models\Scannel\AppUser as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function getUser(Request $request) {

        return UserResource::make(UserModel::with(['profiles', 'profiles.exclusionsFood', 'profiles.exclusionsCosmetic'])->find($request->user()->id));

    }

    public function profileImage($user) {

        if (Storage::disk('local')->exists('user-avatars/' . $user . '.png')) {

            $storedImage = Storage::disk('local')->get('user-avatars/' . $user . '.png');

            return Image::make($storedImage)->response();

        } else {

            $storedImage = Storage::disk('local')->get('default-avatar.jpg');

            return Image::make($storedImage)->response();

        }

    }

}
