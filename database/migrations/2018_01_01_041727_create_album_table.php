<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('album',function (Blueprint $table){
            $table->bigIncrements('al_id');
            $table->string('al_name',10)->nullable();
            $table->string('al_ques',20)->nullable();
            $table->string('al_ans',20)->nullable();
            $table->integer('al_date')->nullable();
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
        //
        Schema::dropIfExists('album');
    }
}
