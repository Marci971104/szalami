<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFelvagottsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('felvagotts', function (Blueprint $table) {
            $table->increments("id");
            $table->string("termek_neve");
            $table->string("termek_ara");
            $table->integer("alapanyag_id")->unsigned();
            $table->foreign("alapanyag_id")->references("id")->on("alapanyag");
            $table->date("gyartasi_ido");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('felvagotts');
    }
}
