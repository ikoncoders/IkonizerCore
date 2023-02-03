<?php
declare(strict_types=1);

namespace IkonizerCore\CommanderBar;

use Exception;

class CommanderFactory
{

    /**
     * Create the command bar object and pass the required object arguments
     *
     * @param object|null $controller
     * @return CommanderBar|CommanderBarInterface
     * @throws Exception
     */
    public function create(?object $controller = null): CommanderBar|CommanderBarInterface
    {
        return new CommanderBar($controller);
    }

}