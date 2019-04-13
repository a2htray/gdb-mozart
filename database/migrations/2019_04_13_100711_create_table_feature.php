<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_feature', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('organism_id');
            $table->string('name');
            $table->string('unique_name');
            $table->unsignedBigInteger('type');
            $table->text('residues');
            $table->unsignedBigInteger('sequence_len');
            $table->string('md5checksum');
            $table->unsignedSmallInteger('is_analysis')->default(1);
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
        Schema::dropIfExists(PACKAGE_NAME . '_feature');
    }
}
