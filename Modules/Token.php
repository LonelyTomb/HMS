<?php

namespace HMS\Modules;

Class Token
{
    public static function generate($lenght)
    {
        $lenght /= 2;
        return bin2hex(openssl_random_pseudo_bytes($lenght,$bstrong));
    }

}