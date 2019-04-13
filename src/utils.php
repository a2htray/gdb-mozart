<?php

use A2htray\GDBMozart\Package;

if (!function_exists('package')) {
    function package($packageName) {
        return new Package($packageName);
    }
}