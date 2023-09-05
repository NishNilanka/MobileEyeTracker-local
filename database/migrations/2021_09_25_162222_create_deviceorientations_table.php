<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviceorientationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deviceorientations', function (Blueprint $table) {
            $table->id();
            $table->text('sid',16)->default('ERROR');
            $table->text('videoid');
            $table->text('frameNumber');
            $table->text('x');
            $table->text('y');
            $table->text('z');
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
        Schema::dropIfExists('deviceorientations');
    }
}
