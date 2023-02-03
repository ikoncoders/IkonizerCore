<?php

declare(strict_types=1);

namespace IkonizerCore\Cookie;

use JetBrains\PhpStorm\ArrayShape;

class CookieConfig
{

    /** @return void */
    public function __construct()
    {
    }

    /**
     * Main cookie configuration default array settings
     * 
     * @return array
     */
    #[ArrayShape(['name' => "string", 'expires' => "int", 'path' => "string", 'domain' => "string", 'secure' => "false", 'httponly' => "bool"])] public function baseConfig(): array
    {
        return [

            'name' => '__magmacore_cookie__',
            'expires' => 3600,
            'path' => '/',
            'domain' => 'localhost',
            'secure' => false,
            'httponly' => true

        ];
    }
}
