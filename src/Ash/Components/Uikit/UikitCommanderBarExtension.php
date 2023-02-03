<?php
declare(strict_types=1);

namespace IkonizerCore\Ash\Components\Uikit;

use Exception;
use IkonizerCore\CommanderBar\CommanderBarInterface;
use IkonizerCore\CommanderBar\CommanderBar;
use IkonizerCore\CommanderBar\CommanderFactory;

class UikitCommanderBarExtension
{

    /** @var string */
    public const NAME = 'uikit_commander_bar';

    /**
     * Get the session flash messages on the fly.
     *
     * @param object|null $controller - the current controller object
     * @param string|null $header
     * @param string|null $headerIcon
     * @return CommanderBarInterface|bool|CommanderBar
     * @throws Exception
     */
    public function register(object $controller = null, ?string $header = null, ?string $headerIcon = null): CommanderBarInterface|bool|CommanderBar
    {
        if (!isset($controller->commander)) {
            return false;
        } else {
            return (new CommanderFactory())->create($controller);
        }
    }
}
