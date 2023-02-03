<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Group\Model;

use IkonizerCore\Base\AbstractBaseModel;
use IkonizerCore\UserManager\Rbac\Group\Entity\GroupRoleEntity;

class GroupRoleModel extends AbstractBaseModel
{

    /** @var string */
    protected const TABLESCHEMA = 'group_role';
    /** @var string */
    protected const TABLESCHEMAID = 'id';
    public const COLUMN_STATUS = [];
    /** @var array $fillable - an array of fields that should not be null */
    protected array $fillable = [
        'group_name',
        'group_slug',
        'group_description',
        'created_byid',
    ];


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
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, GroupRoleEntity::class);
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
    /**
     * Return an array of column values if table supports the column field
     *
     * @return array
     */
    public function getColumnStatus(): array
    {
        return self::COLUMN_STATUS;
    }

}

