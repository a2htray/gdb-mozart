<?php

namespace A2htray\GDBMozart;

use Illuminate\Support\Facades\DB;

class Config
{
    protected $table = 'mozart_config';
    protected static $fetch = false;
    protected static $kvs = [];
    protected static $rawKvs = [];

    /**
     * Fetch all config data from database
     * @param bool $fetch
     * @return array
     */
    public function all(bool $fetch=false)
    {
        $this->rawAll($fetch);
        return self::$kvs;
    }

    /**
     * Get a config value from database
     * @param string $key
     * @param null $default
     * @return mixed
     */
    public function get(string $key, $default=null, $fetch=false)
    {
        if (!self::$fetch) {
            $fetch = true;
        }

        if ($fetch) {
            $kvs = DB::select('SELECT * FROM mozart_config WHERE "key" = "'. $key .'";');
            if (count($kvs) == 0) {
                return $default;
            } else {
                return $this->convert($kvs[0]);
            }
        }

        return self::$kvs[$key] ?? $default;


    }

    /**
     * Configure by pointing a value to a key
     * when invoke method set, all configuration should be fetched again
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value)
    {
        $type = "string";
        switch (gettype($value)) {
            case 'integer':
                $type = "int";
                $value = strval($value);
                break;
            case 'array':
                $type = 'json';
                $value = json_encode($value);
                break;
            case 'double':
                $type = 'float';
                $value = strval($value);
                break;
            case 'object':
                $type = 'object';
                $value = serialize($value);
                break;

        }
        // TODO write the insertion or update logic

    }

    /**
     * Fetch all config data from database
     * @param bool $fetch
     * @return array|\Illuminate\Support\Collection
     */
    public function rawAll(bool $fetch=false)
    {
        if (!self::$fetch) {
            $fetch = true;
        }

        if (!$fetch) {
            return self::$rawKvs;
        }

        self::$rawKvs = array_map([$this, 'convert'], DB::select('SELECT * FROM mozart_config;'));

        self::$kvs = [];

        // loop to remove useless property
        foreach (array_map(function ($md) {
            unset($md['id']);
            unset($md['type']);
            unset($md['created_at']);
            unset($md['updated_at']);

            return $md;
        }, self::$rawKvs) as $md) {
            self::$kvs[$md['key']] = $md['value'];
        }

        self::$fetch = true;

        return self::$rawKvs;
    }

    protected function convert(\stdClass $kv)
    {
        // if the value is null, needn't to be casted
        if (!$kv->value) {
            return (array)$kv;
        }

        switch ($kv->type) {
            case 'int':
                $kv->value = intval($kv->value);
                break;
            case 'float':
                $kv->value = floatval($kv->value);
                break;
            case 'json':
                $kv->value = json_decode($kv->value);
                break;
            case 'object':
                $kv->value = unserialize($kv->value);
                break;
        }
        return (array)$kv;
    }
}
