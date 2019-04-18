<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package A2htray\GDBMozart\Models
 */
class Organism extends Model
{
    protected $table = 'mozart_organism';

    protected $fillable = [
        'abbreviation',
        'genus',
        'specie_id',
        'common_name',
        'infraspecific_name',
        'image_uri',
    ];
}
