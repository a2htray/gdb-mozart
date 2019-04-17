<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCvTerm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_cv_term', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('cv_id');
            $table->string('term_id');
            $table->string('name');
            $table->json('metadata');
            $table->json('relation')->nullable();
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
        Schema::dropIfExists(PACKAGE_NAME . '_cv_term');
    }
}
