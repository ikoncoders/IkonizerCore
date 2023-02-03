<?php

declare(strict_types=1);

namespace IkonizerCore\Ash;

interface ComponentBuilderInterface
{

    /**
     * @param mixed $items
     * @return string
     */
    public function component(mixed $items): string;

}
