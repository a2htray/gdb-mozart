<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOboFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_obo_file', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vocabulary_name');
            $table->string('remote_uri')->nullable();
            $table->string('local_uri');
            $table->string('submit_user_id')->nullable();
            $table->boolean('is_completed')->nullable();
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
        Schema::dropIfExists('table_obo_file');
    }
}
