<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filesystem', function (Blueprint $table) {
            $table->id(); //PK
            $table->text('sid',16)->default('ERROR');
            $table->text('filename');
            $table->text('fileLocation');
            $table->integer('filesize');
            $table->boolean('fileDownloaded')->default(0);
            $table->timestamp('timeCreated');
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
        Schema::dropIfExists('filesystem');
    }
}
