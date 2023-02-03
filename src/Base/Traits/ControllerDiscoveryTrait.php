<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Traits;

use IkonizerCore\Utility\Serializer;

trait ControllerDiscoveryTrait
{

    /**
     * Discover new controller by gatehering the parameters for the controller and inserting it
     * within the database
     *
     * @param object|null $model
     * @param string|null $controllerName
     * @param string|null $classNamespace
     * @return bool
     * @throws \ReflectionException
     */
    public function discoverNewController(object $model = null, ?string $controllerName = null, ?string $classNamespace = null): bool
    {
        /* We want to eliminate the discovery controller itself from showing up */
        if (!empty($controllerName) /*&& $controllerName !== 'discovery'*/) {
            $fields = ['controller' => $controllerName, 'methods' => Serializer::compress($this->getActionMethods($classNamespace)), 'active' => 0];
            return $model
                ->getEm()
                ->getCrud()
                ->create($fields);
        }

        return false;
    }

}