<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Felvagott extends Model
{
    use HasFactory;
    protected $fillable =[  
        "termek_neve",
        "termek_ara",
        "alapanyag_id",
        "gyartasi_ido"


    ];

}
