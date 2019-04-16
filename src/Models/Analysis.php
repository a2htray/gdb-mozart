<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package A2htray\GDBMozart\Models
 */
class Analysis extends Model
{
    protected $table = 'mozart_analysis';

    protected $fillable = [
        'name',
        'description',
        'program',
        'program_version',
        'algorithm',
        'source_name',
        'source_uri',
        'executed_at'
    ];



}