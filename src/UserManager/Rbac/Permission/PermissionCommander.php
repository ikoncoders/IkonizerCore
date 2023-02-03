<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Permission;

use Exception;
use IkonizerCore\CommanderBar\ApplicationCommanderInterface;
use IkonizerCore\CommanderBar\ApplicationCommanderTrait;
use IkonizerCore\CommanderBar\CommanderUnsetterTrait;

class PermissionCommander extends PermissionModel implements ApplicationCommanderInterface
{

    /** @var ApplicationCommanderTrait - this is required */
    use ApplicationCommanderTrait;
    use CommanderUnsetterTrait;

    /**
     * Return an array of all the inner routes within the user model
     * @var array
     */
    protected const INNER_ROUTES = [
        'index',
        'new',
        'edit',
        'bulk',
        'settings',
        'import',
        'export'
    ];

    private array $noCommander = [];
    private array $noNotification = self::INNER_ROUTES;
    private array $noCustomizer = ['new', 'edit'];
    private array $noManager = ['new'];
    private array $noAction = [];
    private array $noFilter = ['new', 'edit'];

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
        return $this->findYml('permission');
    }

    /**
     * Display a sparkline graph for this controller index route
     *
     * @return string
     */
    public function getGraphs(): string
    {
        return '<div id="sparkline"></div>';
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
            'index' => $this->getStatusColumnFromQueryParams($controller),
            'new' => 'Create New Permission',
            'edit' => "Edit " . $this->getHeaderBuildEdit($controller, 'permission_name'),
            'assigned' => 'Role Assignment',
            'settings' => 'Permission Settings',
            'bulk' => 'Bulk Delete',
            'import' => 'Import Data',
            'export' => 'Export Data',
            default => "Unknown"
        };
    }

}
