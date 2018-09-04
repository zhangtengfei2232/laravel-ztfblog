<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artical',function(Blueprint $table){
            $table->bigIncrements('art_id');
            $table->string('art_title',50);
            $table->integer('art_type');
            $table->bigInteger('art_date')->nullable();
            $table->bigInteger('art_revcout');
            $table->text('art_text');
            $table->timestamps();
    });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artical');
        //
    }
}
