<?php

namespace A2htray\GDBMozart;


class Package
{
    private $name;
    private $prefix;

    public function __construct(string $packageName)
    {
        $this->name = $packageName;
        $this->prefix = $this->name;
    }

    public function makeTableName(string $tableName)
    {
        return $this->prefix . '_' . $tableName;
    }
}