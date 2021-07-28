<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PresupuestosProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('presupuestos_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_presupuesto')->unsigned();
            $table->integer('id_producto')->unsigned();
            $table->integer('cantidad');
            $table->timestamps();
            //FK
            $table->foreign('id_presupuesto')->references('id')->on('presupuestos');
            $table->foreign('id_producto')->references('id')->on('productos');
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
        Schema::dropIfExists('presupuestos_productos');
    }
}
