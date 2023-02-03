<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Support;

use IkonizerCore\CommanderBar\ApplicationCommanderInterface;
use IkonizerCore\CommanderBar\ApplicationCommanderTrait;
use IkonizerCore\CommanderBar\CommanderUnsetterTrait;
use Exception;

class SupportCommander implements ApplicationCommanderInterface
{

    /** @var ApplicationCommanderTrait - this is required */
    use ApplicationCommanderTrait;
    use CommanderUnsetterTrait;

    /**
     * Return an array of all the inner routes within the user model
     * @var array
     */
    protected const INNER_ROUTES = [
        'changelog',
        'documentation'
    ];

    private array $noCommander = [];
    private array $noNotification = self::INNER_ROUTES;
    private array $noCustomizer = self::INNER_ROUTES;
    private array $noManager = self::INNER_ROUTES;
    private array $noAction = self::INNER_ROUTES;
    private array $noFilter = self::INNER_ROUTES;

    private object $controller;

    /**
     * Get the specific yaml file which helps to render some text within the specified
     * html template.
     *
     * @return array
     * @throws Exception
     */
    public function getYml(): array
    {
        return $this->findYml('support');
    }

    /**
     * Display a sparkline graph for this controller index route
     *
     * @return string
     */
    public function getGraphs(): string
    {
        return '';
    }

    /**
     * Dynamically change commander bar header based on the current route
     *
     * @param object $controller
     * @return string
     * @throws Exception
     */
    public function getHeaderBuild(object $controller): string
    {
        $this->getHeaderBuildException($controller, self::INNER_ROUTES);
        $this->controller = $controller;

        return match ($controller->thisRouteAction()) {
            'documentation' => 'Documentation',
            'changelog' => 'Changelog',
            default => "Unknown"
        };
    }

}
