<?php

namespace A2htray\GDBMozart\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string uri_pattern
 * @property string is_group
 * @package A2htray\GDBMozart\Models
 */
class Menu extends Model
{
    protected $fillable = [
        'package_id',
        'name',
        'region_type',
        'uri_pattern',
        'is_group',
        'parent_id',
        'rank',
    ];

    /**
     * Replace the origin url with options
     * 
     * @param array $options
     * @throws \Exception
     * @return string
     *
     * e.g. /specie/{specie_id}/organism/{organism_id}
     *
     * $options = ['specie' => 1, 'organism_id' => 2]
     *
     * result will be '/organism/1'
     */
    public function getUri(array $options)
    {
        if ($this->is_group) {
            return '';
        }

        if ($this->uri_pattern) {
            throw new \Exception('The pattern of a menu uri could not be empty');
        }

        $matches = null;
        $pattern = '/\{(.*?)\}/';
        $uri = $this->uri_pattern;
        
        if (preg_match_all($pattern, $this->uri_pattern , $matches)) {
            $keys = $matches[1];

            foreach ($keys as $key) {
                if (isset($options[$key])) {
                    $uri = str_replace('{' . $key . '}', $options[$key], $uri);
                } else {
                    throw new \Exception('Param $options must contains the key ' . $key);
                }
            }

            return $uri;
        } else {
            return $this->uri_pattern;
        }
    }
}