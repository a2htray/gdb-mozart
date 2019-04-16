<?php
/**
 * Created by PhpStorm.
 * User: yuanjianyu
 * Date: 2019/4/16
 * Time: 21:29
 */

namespace A2htray\GDBMozart\Models;


use Illuminate\Database\Eloquent\Model;

class OboFile extends Model
{
    protected $table = 'mozart_obo_file';

    protected $fillable = [
        'vocabulary_name',
        'remote_uri',
        'local_uri',
        'submit_user_id',
        'is_completed',
    ];
}
