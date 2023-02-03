<?php
declare(strict_types=1);

namespace IkonizerCore\Container;

use Closure;

/** PSR-11 Container */
interface SettableInterface
{

    /**
     * Explicitly set one or more dependency. Dependencies are auto set when
     * using the get() method to fetch a unset dependency
     *
     * @param string $id Identifier of the entry to look for.
     * @param Closure|null $concrete
     * @return void
     */
    public function set(string $id, Closure $concrete = null): void;
}
