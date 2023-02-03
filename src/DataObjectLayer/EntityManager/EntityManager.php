<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\EntityManager;

class EntityManager implements EntityManagerInterface
{

    /**
     * @var CrudInterface
     */
    protected CrudInterface $crud;

    /**
     * Main constructor class
     * 
     * @return void
     */
    public function __construct(CrudInterface $crud)
    {
        $this->crud = $crud;
    }

    /**
     * @inheritDoc
     */
    public function getCrud() : Object
    {
        return $this->crud;
    }

}
