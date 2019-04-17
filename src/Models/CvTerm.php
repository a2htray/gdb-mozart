<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @package A2htray\GDBMozart\Models
 */
class CvTerm extends Model
{
    protected $table = 'mozart_cv_term';

    protected $fillable = [
        'cv_id',
        'term_id',
        'name',
        'metadata',
        'relation',
    ];



}
