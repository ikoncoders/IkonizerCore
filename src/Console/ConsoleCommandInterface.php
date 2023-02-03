<?php
declare(strict_types=1);

namespace IkonizerCore\Console;

interface ConsoleCommandInterface
{

    public function dispatch(): int;

}
