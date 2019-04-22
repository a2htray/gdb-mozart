<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package A2htray\GDBMozart\Models
 */
class Specie extends Model
{
    protected $table = 'mozart_specie';

    protected $fillable = [
        'name',
        'description',
    ];



}
