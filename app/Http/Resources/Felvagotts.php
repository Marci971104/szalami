<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Felvagotts extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "termek_neve"=>$this->termek_neve,
            "termek_ara"=>$this->termek_ara,
            "alapanyag_id"=>$this->alapanyag_id,
            "gyartasi_ido"=>$this->gyartasi_ido->format("m/d/Y")
            
            
        ];
    }
}
