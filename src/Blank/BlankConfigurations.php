<?php
namespace IkonizerCore\Blank;

class BlankConfigurations
{

    public static function configurations(): array
    {
        return [
            'bundler' => [
                'name' => 'MagmaBlank',
                'description' => 'Blank component',
                'version' => '1.0',
                'min_php_version' => '8.0.2',
                'factory' => [
                    'accessor' => 'blanker',
                    'class' => \IkonizerCore\Blank\BlankFactory::class
                ],
                'optional_parameters' => [
                    'sanitizer' => \IkonizerCore\Utility\Sanitizer::class,
                ],
                'overriding_options' => true, /* false will prevent options from being overriden */
                'overriding_yml' => 'magma_blank', /* files which holds overriding options */
                'drivers' => [
                    'default_driver' => 'native',
                    'sources' => [
                        'native' => \IkonizerCore\Blank\Drivers\NativeBlankDriver::class,
                        'pdo' => \IkonizerCore\Blank\Drivers\PdoBlankDriver::class,
                        'array' => \IkonizerCore\Blank\Drivers\ArrayBlankDriver::class
                    ]
                ],
                'options' => [
                    'timeout' => 30,
                    'attempts' => 3,
                    'use_globals' => true,
                    'global_key' => 'blank_global'
                ]

            ]
        ];

    }

}