<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReportes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->text('observacion')->nullable();
            $table->date('fecha');
            $table->integer('users_id')->unsigned();            
            $table->foreign('users_id')->references('id')->on('users');
            $table->timestamps();
        });
    }



    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_reportes');
    }
}
