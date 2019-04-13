<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//1	analysis_id	int8	8	-1	true
//2	name	varchar	-1	259	false	"A way of grouping analyses. This
//    should be a handy short identifier that can help people find an
//    analysis they want. For instance ""tRNAscan"", ""cDNA"", ""FlyPep"",
//    ""SwissProt"", and it should not be assumed to be unique. For instance, there may be lots of separate analyses done against a cDNA database."
//3	description	text	-1	-1	false
//4	program	varchar	-1	259	true	Program name, e.g. blastx, blastp, sim4, genscan.
//5	programversion	varchar	-1	259	true	Version description, e.g. TBLASTX 2.0MP-WashU [09-Nov-2000].
//6	algorithm	varchar	-1	259	false	Algorithm name, e.g. blast.
//7	sourcename	varchar	-1	259	false	Source name, e.g. cDNA, SwissProt.
//8	sourceversion	varchar	-1	259	false
//9	sourceuri	text	-1	-1	false	This is an optional, permanent URL or URI for the source of the  analysis. The idea is that someone could recreate the analysis directly by going to this URI and fetching the source data (e.g. the blast database, or the training model).
//10	timeexecuted	timestamp	8	-1	true


class CreateTableAnalysis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(PACKAGE_NAME . '_analysis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('program');
            $table->string('program_version');
            $table->string('algorithm')->nullable();
            $table->string('source_name')->nullable();
            $table->string('source_uri')->nullable();
            $table->timestamp('executed_at');
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
        Schema::dropIfExists(PACKAGE_NAME . '_analysis');
    }
}
