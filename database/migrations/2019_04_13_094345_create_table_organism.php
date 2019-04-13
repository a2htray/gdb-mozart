<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//1	id	int8	8	-1	true
//2	abbreviation	varchar	-1	259	false
//3	genus	varchar	-1	259	true
//4	specie_id	int8	8	-1	true
//5	common_name	varchar	-1	259	false
//6	infraspecific_name	varchar	-1	259	false
//7	avatar_uri	varchar	-1	259	false
//8	created_at	timestamp	8	0	false
//9	updated_at	timestamp	8	0	false

class CreateTableOrganism extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_organism', function (Blueprint $table) {
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
        Schema::dropIfExists('table_organism');
    }
}
