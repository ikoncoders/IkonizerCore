<?php
declare(strict_types=1);

namespace IkonizerCore\Cache;

use JetBrains\PhpStorm\ArrayShape;

class CacheConfig
{

    /** @var string */
    private const DEFAULT_DRIVER = 'native_storage';

    /**
     * Main session configuration default array settings
     * 
     * @return array
     */
    #[ArrayShape(['use_cache' => "bool", 'key' => "string", 'cache_path' => "string", 'cache_expires' => "int", 'default_storage' => "string", 'drivers' => "array[]"])] public function baseConfiguration(): array
    {
        return [
            'use_cache' => true,
            'key' => 'auto',
            'cache_path' => '/Storage/Cache/',
            'cache_expires' => 3600,
            'default_storage' => self::DEFAULT_DRIVER,
            'drivers' => [
                'native_storage' => [
                    'class' => '\IkonizerCore\Cache\Storage\NativeCacheStorage',
                    'default' => true
                ],
                'array_storage' => [
                    'class' => '\IkonizerCore\Cache\Storage\ArrayCacheStorage',
                    'default' => false

                ],
                'pdo_storage' => [
                    'class' => '\IkonizerCore\Cache\Storage\PdoCacheStorage',
                    'default' => false

                ]
            ]
        ];
    }
}
