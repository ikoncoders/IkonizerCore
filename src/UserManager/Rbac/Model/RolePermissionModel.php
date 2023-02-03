<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Model;

use IkonizerCore\UserManager\Rbac\Entity\RolePermissionEntity;
use IkonizerCore\Base\AbstractBaseModel;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;

class RolePermissionModel extends AbstractBaseModel
{

    /** @var string */
    protected const TABLESCHEMA = 'role_permission';
    /** @var string */
    protected const TABLESCHEMAID = 'id';

    /**
     * Main constructor class which passes the relevant information to the
     * base model parent constructor. This allows the repository to fetch the
     * correct information from the database based on the model/entity
     *
     * @return void
     * @throws BaseInvalidArgumentException
     */
    public function __construct()
    {
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, RolePermissionEntity::class);
    }

    /**
     * Guard these IDs from being deleted etc..
     *
     * @return array
     */
    public function guardedID(): array
    {
        return [];
    }


}
