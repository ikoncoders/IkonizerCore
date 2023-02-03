<?php
declare(strict_types=1);

namespace IkonizerCore\Console;

interface ConsoleInterface
{
    public function create();
    public function registerCommands();
}
