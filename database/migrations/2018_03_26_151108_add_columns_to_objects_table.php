<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->text('original_filename')->nullable()->after('filename');
            $table->string('mime_type')->nullable()->after('original_filename');
            $table->unsignedInteger('filesize')->nullable()->after('mime_type');
            $table->string('file_uid')->nullable()->after('filesize');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn(['original_filename', 'mime_type', 'filesize', 'file_uid']);
        });
    }
}
