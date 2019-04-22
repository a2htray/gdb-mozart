<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrganism extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_organism', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('abbreviation')->nullable();
            $table->string('genus');
            $table->unsignedBigInteger('specie_id');
            $table->string('common_name');
            $table->string('infraspecific_name')->nullable();
            $table->string('image_uri')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists(PACKAGE_NAME . '_organism');
    }
}
