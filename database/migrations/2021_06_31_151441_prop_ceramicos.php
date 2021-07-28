<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropCeramicos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('prop_ceramicos', function (Blueprint $table){
            $table->increments('id');
            $table->string('color');
            $table->string('dim');
            $table->string('uso');
            $table->string('terminacion');
            $table->integer('id_pastina')->unsigned();
            $table->timestamps();
            //FK
            $table->foreign('id_pastina')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::dropIfExists('prop_ceramicos');
    }
}
