<?php

namespace A2htray\GDBMozart\Logic\Auth;


interface LoginStrategy
{
    public function login();
    public function afterLogin();
}