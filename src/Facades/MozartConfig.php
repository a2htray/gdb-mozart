<?php
namespace A2htray\GDBMozart\Facades;

use A2htray\GDBMozart\Models\Config;
use Illuminate\Support\Facades\Facade;

/**
 * Class MozartConfig
 *
 * @method static array getAll(bool $fetch)
 * @method static array getRawAll(bool $fetch)
 * @method static mixed get(string $key, $default=null)
 * @method static void set(string $key, mixed $value)
 *
 * @package App\Facades
 */
class MozartConfig extends Facade
{
    protected static $instance = null;

    protected static function getFacadeAccessor()
    {
        if (self::$instance) {
            return self::$instance;
        }

        self::$instance = new Config();

        return self::$instance;
    }
}