<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->id();
            $table->string('day')->nullable();
            $table->string("level")->nullable();
            $table->string("7-8")->nullable();
            $table->string("8-9")->nullable();
            $table->string("9-10")->nullable();
            $table->string("10-11")->nullable();
            $table->string("11-12")->nullable();
            $table->string("12-01")->nullable();
            $table->string("01-02")->nullable();
            $table->string("02-03")->nullable();
            $table->string("03-04")->nullable();
            $table->string("04-05")->nullable();
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
        Schema::dropIfExists('periods');
    }
}
