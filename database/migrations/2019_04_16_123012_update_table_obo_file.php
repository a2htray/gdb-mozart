<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableOboFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(PACKAGE_NAME . '_obo_file', function (Blueprint $table) {
             $table->string('remote_uri')->nullable()->change();
             $table->string('submit_user_id')->nullable();
             $table->boolean('is_completed')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(PACKAGE_NAME . '_obo_file', function (Blueprint $table) {
            $table->string('remote_uri')->change();
            $table->removeColumn('submit_user_id');
            $table->removeColumn('is_completed');
        });
    }
}
