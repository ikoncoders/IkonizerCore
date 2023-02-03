<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\DataRelationship\Relationships;

use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryFactory;
use IkonizerCore\DataObjectLayer\DataRelationship\DataRelationship;
use IkonizerCore\DataObjectLayer\DataRelationship\DataLayerClientFacade;

/**
 * Both tables can have only one record on each side of the relationship.
 * each primary key value relates to none or only one record in the related table
 */
class OneToMany extends DataRelationship
{

    public function __construct()
    {
    }

    public function findObjectBy()
    {

    }
}