<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PropBlangino extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('prop_blangino', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dim');
            $table->float('peso_unitario');
            $table->float('peso_m2');
            $table->string('terminacion');
            $table->string('uso');
            $table->float('cant_m2');
            $table->integer('id_pastina')->unsigned();
            $table->timestamps();
            //fk
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
        Schema::dropIfExists('prop_blangino');
    }
}
