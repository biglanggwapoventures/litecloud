<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('parent_directory_id')->nullable();
            $table->unsignedInteger('owner_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('parent_directory_id')->references('id')->on('directories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('directories');
    }
}
