<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//1	id	int8	8	-1	true
//2	key	varchar	-1	259	true
//3	type	int2	2	-1	true
//4	value	text	-1	-1	false
//5	created_at	timestamp	8	0	false
//6	updated_at	timestamp	8	0	false


class CreateTableConfig extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_config', function (Blueprint $table) {
            $table->bigIncrements('id');
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
        Schema::dropIfExists('table_config');
    }
}
