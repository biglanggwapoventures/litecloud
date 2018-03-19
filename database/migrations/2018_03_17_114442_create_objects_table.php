<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objects', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('object_type', ['folder', 'file']);
            $table->boolean('is_root_folder')->default(false);
            $table->unsignedInteger('object_parent')->nullable();
            $table->unsignedInteger('owner_id')->nullable();
            $table->string('filename', 200)->nullable();
            $table->text('path')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('object_parent')->references('id')->on('objects')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('objects');
    }
}
