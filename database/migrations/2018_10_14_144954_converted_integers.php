<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertedIntegers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('converted_integers', function (Blueprint $table) {
         $table->increments('id');
         $table->string('romanNumeral')->index();
         $table->integer('NumberOfTimesConverted');
         $table->dateTime('lastConversion');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('converted_integers');
    }
}
