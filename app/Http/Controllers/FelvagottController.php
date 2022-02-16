<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Http\Resources\Felvagott as FelvagottResources;
use App\Http\Resources\Alapanyag as AlapanyagResources;
use Illuminate\Support\Facades\DB;
use App\Models\Felvagott;
use App\Models\Alapanyag;



class FelvagottController extends BaseController
{
    public function index() {
        $termek_neve = Felvagott::all();
        return $this -> sendResponse(FelvagottResources::collection($termek_neve),"Összes felvágott: ");
    }
    public function store(Request $request){
        //dd($request);
        $input = $request->all();
        $validator = Validator::make($input,[
            "title" => "required",
            "description" => "required"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $szalami = Felvagott::create($input);

        return $this->sendResponse(new FelvagottResources($szalami),"Felvágott: ");
    }
    public function show($id){
        $szalami = Felvagott::find($id);
        if(is_null($szalami)){
            return $this->senError("Nincs ilyen szalami");
        }
        return $this->sendResponse(new FelvagottResources($szalami),"Felvágott betöltve");
    }
    public function update(Request $request, Felvagott $szalami){
        $input = $request -> all();
        $validator = Validator::make($input,[
            "title" => "required",
            "description" => "required"
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        
        $szalami -> title = $input["title"];
        $szalami -> description = $input["description"];
        $szalami -> save();

        return $this->sendResponse(new FelvagottResources($szalami),"Felvágott módosítva");
    }
    public function destroy($id){
        Felvagott::destroy($id);
        return $this->sendResponse([],"Felvágott megsemmisítve!!");
    }
    public function felvagott_search( $szalami_neve ) {
        
        return Felvagott::where( "szalami_neve", "like", "%".$szalami_neve."%" )->get();
    }
    public function alapanyag_search( $alapanyag_neve ) {
        
        return Alapanyag::where( "alapanyag_neve", "like", "%".$alapanyag_neve."%" )->get();
    }
}