<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\Scannel\User as UserResource;
use App\Models\Scannel\ExclusionCosmetic;
use App\Models\Scannel\ExclusionFood;
use App\Models\Scannel\AppUser as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function createProfile(CreateProfileRequest $createProfileRequest) {

        if($lastProfile = $createProfileRequest->user()->profiles()->latest()->first()) {
            $counter = explode('-', $lastProfile->scannelid)[1];
        } else {
            $counter = 1;
        }


        $data = $createProfileRequest->input('personalData');

        $data['scannelid'] = $createProfileRequest->user()->scannelid . '-' . $counter;

        $profile = $createProfileRequest->user()->profiles()->create($data);

        foreach($createProfileRequest->input('excludeionFoodIngredients') as $ingredientFood) {

            $relation = new ExclusionFood;
            $relation->profile_id = $profile->id;
            $relation->ingredient_id = $ingredientFood;
            $relation->save();
        }

        foreach($createProfileRequest->input('excludeionCosmeticIngredients') as $ingredientCosmetics) {

            $relation = new ExclusionCosmetic;
            $relation->profile_id = $profile->id;
            $relation->ingredient_id = $ingredientCosmetics;
            $relation->save();

        }

        return UserResource::make(UserModel::with(['profiles', 'profiles.exclusionsFood', 'profiles.exclusionsCosmetic'])->find($createProfileRequest->user()->id));

    }

    public function updateProfile($profile, UpdateProfileRequest $updateProfileRequest) {

        $data = $updateProfileRequest->input('personalData');
        unset($data['avatar']);

        $updateProfileRequest->user()->profiles()->where('id', $profile)->update($data);

        ExclusionCosmetic::where('profile_id', $profile)->delete();
        ExclusionFood::where('profile_id', $profile)->delete();

        if(strpos($updateProfileRequest->input('personalData')['avatar'], 'base64') !== -1) {

            $image = Image::make($updateProfileRequest->input('personalData')['avatar']);
            $image->resize('300');
            $image->save(storage_path('app/profile-avatars/' . $profile . '.png'));

        }

        foreach($updateProfileRequest->input('excludeionFoodIngredients') as $ingredientFood) {

            $relation = new ExclusionFood;
            $relation->profile_id = $profile;
            $relation->ingredient_id = $ingredientFood;
            $relation->save();
        }

        foreach($updateProfileRequest->input('excludeionCosmeticIngredients') as $ingredientCosmetics) {

            $relation = new ExclusionCosmetic;
            $relation->profile_id = $profile;
            $relation->ingredient_id = $ingredientCosmetics;
            $relation->save();

        }

        return UserResource::make(UserModel::with(['profiles', 'profiles.exclusionsFood', 'profiles.exclusionsCosmetic'])->find($updateProfileRequest->user()->id));

    }

    public function profileImage($profile) {

        if (Storage::disk('local')->exists('profile-avatars/' . $profile . '.png')) {

            $storedImage = Storage::disk('local')->get('profile-avatars/' . $profile . '.png');

            return Image::make($storedImage)->response();

        } else {

            $storedImage = Storage::disk('local')->get('default-avatar.jpg');

            return Image::make($storedImage)->response();

        }


    }

}
