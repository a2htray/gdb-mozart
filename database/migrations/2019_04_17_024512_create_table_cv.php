<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_cv', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('namespace')->nullable();
            $table->string('ontology')->nullable();
            $table->json('metadata');
            $table->json('def_metadata')->nullable();
            $table->unsignedInteger('upload_user_id');
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
        Schema::dropIfExists(PACKAGE_NAME . '_cv');
    }
}
