<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\EntityManager;

interface EntityManagerInterface
{
    /**
     * Get the crud object which will expose all the method within our crud class
     * 
     * @return Object
     */
    public function getCrud() : Object;

}
