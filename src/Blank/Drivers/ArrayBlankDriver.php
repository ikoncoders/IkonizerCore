<?php

namespace IkonizerCore\Blank\Drivers;

use JetBrains\PhpStorm\Pure;
use IkonizerCore\Contracts\ConfigurationInterface;

class ArrayBlankDriver extends AbstractBlankDriver
{

    #[Pure] public function __construct(ConfigurationInterface $overridingConfig)
    {
        parent::__construct($overridingConfig);
    }

    public function setBlank(string $key, mixed $value): void
    {
    }

    public function getBlank(string $key): mixed
    {
    }

}