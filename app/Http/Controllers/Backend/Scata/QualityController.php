<?php

namespace App\Http\Controllers\Backend\Scata;

use App\Models\HelpDisk;
use App\Http\Controllers\Controller;
use App\Models\Scata\QualitySeal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class QualityController extends Controller
{
    public function __construct()
    {
        $this->middleware("concurrent.operations:App\Models\Scata\QualitySeal")->only("update", "quality");
        HelpDisk::checkIfExists("qualities");
    }

    public function qualities(Request $request)
    {

        $qualities = QualitySeal::all();

        return view('backend.scata.quality.qualities')->with([
            'qualities' => $qualities,
        ]);

    }

    public function quality(QualitySeal $quality, Request $request)
    {

        return view('backend.scata.quality.quality')->with([
            'quality' => $quality,
        ]);

    }

    public function update(QualitySeal $qualitySeal, Request $request)
    {

        $filename = $qualitySeal->logo;

        if ($request->hasFile('file')) {

            Storage::disk('qualityseals')->delete($qualitySeal->logo);

            $filename = Str::slug($request->name) . '-' . now()->format('YmdHis') . '.png';

            $image = Image::make($request->file('file'));

            Storage::disk('qualityseals')->put('/' . $filename, $image->encode('png'));

            Artisan::call('storage:link');

        }

        $qualitySeal->update([
            'name' => $request->name,
            'logo' => $filename,
            'description' => $request->description,
        ]);

        return Redirect::back();

    }

    public function getCreate(Request $request)
    {

        return view('backend.scata.quality.create');

    }

    public function create(Request $request)
    {

        $qualitySeal = new QualitySeal();

        $qualitySeal->name = $request->name;
        $qualitySeal->description = $request->description;

        if ($request->hasFile('file')) {

            $filename = Str::slug($request->name) . '-' . now()->format('YmdHis') . '.png';

            $qualitySeal->logo = $filename;

            $image = Image::make($request->file('file'));

            Storage::disk('qualityseals')->put('/' . $filename, $image->encode('png'));

            Artisan::call('storage:link');

        }


        $qualitySeal->save();

        return Redirect::route('get.scata.qualities');

    }
}
