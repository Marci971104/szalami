<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use Validator;
use App\Http\Resources\Felvagotts as FelvagottsResources;
use App\Http\Resources\Alapanyag as AlapanyagResources;
use Illuminate\Support\Facades\DB;
use App\Models\Felvagotts;
use App\Models\Alapanyag;
               



class FelvagottsController extends BaseController
{
    public function index() {
        $Felvagotts = Felvagotts::all();
        return $this -> sendResponse(FelvagottsResources::collection($Felvagotts),"Összes felvágott: ");
    }
    public function store(Request $request){
        //dd($request);
        $input = $request->all();
        $validator = Validator::make($input,[
            "termek_neve"=>"required",
            "termek_ara"=>"required",
            "alapanyag_id"=>"required",
            "gyartasi_ido"=>"required"
    
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        $Felvagotts = Felvagotts::create($input);

        return $this->sendResponse(new FelvagottsResources($Felvagotts),"Felvágott hozzáadva ");
    }
    public function show($id){
        $Felvagotts = Felvagotts::find($id);
        if(is_null($Felvagotts)){
            return $this->senError("Nincs ilyen szalami");
        }
        return $this->sendResponse(new FelvagottsResources($Felvagotts),"Felvágott betöltve");
    }
    public function update(Request $request, Felvagotts $Felvagotts){
        $input = $request -> all();
        $validator = Validator::make($input,[
            "termek_neve"=>"required",
            "termek_ara"=>"required",
            "alapanyag_id"=>"required",
            "gyartasi_ido"=>"required"
            
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());
        }
        
        $Felvagotts -> termek_neve = $input["termek_neve"];
        $Felvagotts -> termek_ara = $input["termek_ara"];
        $Felvagotts -> alapanyag_id = $input["alapanyag_id"];
        $Felvagotts -> gyartasi_ido = $input["gyartasi_ido"];
        $Felvagotts -> save();

        return $this->sendResponse(new FelvagottsResources($Felvagotts),"Felvágott módosítva");
    }
    public function destroy($id){
        Felvagotts::destroy($id);
        return $this->sendResponse([],"Felvágott megsemmisítve!!");
    }
    public function felvagott_search( $Felvagotts ) {
        
        return Felvagotts::where( "termek_neve", "like", "%".$termek_neve."%" )->get();
    }
    public function alapanyag_search( $alapanyag_neve ) {
        
        return Alapanyag::where( "alapanyag_neve", "like", "%".$alapanyag_neve."%" )->get();
    }
}