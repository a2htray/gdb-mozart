<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//1	id	int8	8	-1	true
//2	name	varchar	-1	259	true
//3	email	varchar	-1	259	true
//4	email_verified_at	timestamp	8	0	false
//5	password	varchar	-1	259	true
//6	remember_token	varchar	-1	104	false
//7	created_at	timestamp	8	0	false
//8	updated_at	timestamp	8	0	false

class CreateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_user', function (Blueprint $table) {
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
        Schema::dropIfExists('table_user');
    }
}
