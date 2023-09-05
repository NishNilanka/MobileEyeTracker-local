<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamerafeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('camerafeatures', function (Blueprint $table) {
            $table->id();
			$table->text('sid',16)->default('ERROR');
            $table->text('fps');
            $table->text('height');
            $table->text('width');
            $table->text('aspectratio');
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
        Schema::dropIfExists('camerafeatures');
    }
}
