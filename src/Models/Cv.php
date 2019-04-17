<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package A2htray\GDBMozart\Models
 */
class Cv extends Model
{
    protected $table = 'mozart_cv';

    protected $fillable = [
        'namespace',
        'ontology',
        'metadata',
        'def_metadata',
        'upload_id',
    ];



}
