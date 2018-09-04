<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('speach',function (Blueprint $table){
            $table->bigIncrements('spe_id');
            $table->integer('spe_date')->nullable();
            $table->text('spe_text');
            $table->integer('users_id');
            $table->integer('father_id')->nullable();
            $table->integer('uspe_id');
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
        Schema::dropIfExists('speach');
    }
}
