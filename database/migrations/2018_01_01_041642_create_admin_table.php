<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin',function (Blueprint $table){
            $table->bigIncrements('adm_id');
            $table->string('adm_name',6)->unique();
            $table->string('adm_psd',32);
            $table->string('adm_sex',6)->nullable();
            $table->string('adm_adres',20)->nullable();
            $table->string('adm_cont',20)->unique();
            $table->string('adm_emile',20)->nullable();
            $table->string('adm_year',20)->nullable();
            $table->string('adm_hoby',20)->nullable();
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
        Schema::dropIfExists('admin');
        }
}
