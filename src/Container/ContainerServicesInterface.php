<?php
declare(strict_types=1);

namespace IkonizerCore\Container;

/** PSR-11 Container */
interface ContainerServicesInterface
{

    /**
     * Set Class services
     *
     * @param array $services
     * @return self
     */
    public function setServices(array $services = []): self;

    /**
     * Get class service or services
     *
     * @return array
     */
    public function getServices(): array;

    /**
     * Unregister a service from being instantiable
     *
     * @param array $args - optional argument
     * @return ContainerServicesInterface ;
     */
    public function unregister(array $args = []): self;

    /**
     * Register service or services with auto-wiring
     *
     * @return void
     */
    public function register();
}
