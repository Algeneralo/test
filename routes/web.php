<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('{lang}')->group(function() {

    Route::get('verify-email/{scannelid}/{email}', 'Api\v1\AuthController@verifyEmail')->name('verify-email');

});

Route::prefix('app')->group(function() {

    Route::get('reset-password', function() {

        return view('web.reset-password');

    })->middleware('signed')->name('get.app.reset-password');

    Route::post('reset-password', 'Backend\AppUsersController@resetPassword')->name('post.app.reset-password');

});

Route::get('ocr', function() {

        /*$request = Http::withHeaders([
            'cache-control' => 'no-cache',
            'content-type' => 'application/json',
            'ocp-apim-subscription-key' => config('scannel.ocr.azure-cognitive-api.key'),
            'orientation' => 'Up',
        ])->post('https://westeurope.api.cognitive.microsoft.com/vision/v2.0/recognizeText?mode=Printed', [
            'url' => 'https://scata-app.cdemo.me/api/pics/scata/31_2.jpg'
        ]);

        $operationLocation = $request->header('Operation-Location');



        return $operationLocation;
*/

    $image = \App\Models\ScataOld\ProductImage::find(71);

    \App\Jobs\OCR\StartOCR::dispatch($image);
});

Route::get('storage-link', function () {

    Artisan::call('storage:link');

});



