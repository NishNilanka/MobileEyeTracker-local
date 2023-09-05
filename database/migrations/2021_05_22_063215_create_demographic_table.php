<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemographicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demographics', function (Blueprint $table) {
            $table->id(); //PK
            $table->text('sid',16)->default('ERROR');
            $table->text('age');
            $table->text('glasses');
            $table->text('gender');
            $table->boolean('deviceMobile');
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
        Schema::dropIfExists('demographics');
    }
}
