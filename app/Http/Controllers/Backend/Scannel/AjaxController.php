<?php


namespace App\Http\Controllers\Backend\Scannel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Models\Scata\Ingredient;


class AjaxController extends Controller
{

    public function ajaxRequest()
    {
        return view('backend.scannel.ajaxRequest');
    }


    public function ajaxRequestPost(Request $request)
    {
        $input = $request->all();

        if($request->tab === "ingredients")
            return $this->getAllFromDBingredients($request);
        if($request->tab === "createingredient"){
            if($request->type == "")
                return response()->json(['message' => 'Type fehlt!' ],500);

            if(Ingredient::where('slug', $request->input('name'))->count() > 0)
                return response()->json(['message' => 'Zutat mit diesem Namen ('.$request->input('name').')existiert bereits!' ],500);

            $ingredient = new Ingredient;
            $ingredient->name = ['de' => $request->input('name')];
            $ingredient->slug = $request->input('name');
            $description['de'] = $request->input('description');
            $ingredient->description = $description;     
            
            $ingredient->type  = implode (',',$request->type);
            $ingredient->save();
    
            if($ingredient->id)
                return response()->json(['success' => '1', 'result' => $ingredient->id ]);
        }

        return response()->json(['error' => '1', 'result' => $request->tab ],500);
    }

    public function getAllFromDBingredients(Request $request){
        $results = DB::select("select slug from ingredients where type = '.$request->type.'");
        return response()->json(['success' => '1', 'result' => $results ]);
    }
}