<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Group;

use IkonizerCore\Base\AbstractBaseModel;

class GroupModel extends AbstractBaseModel
{

    /** @var string */
    protected const TABLESCHEMA = 'groups';
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
    /* columns to include when cloning object */
    protected array $cloneableKeys = ['group_name', 'group_description'];
    /* columns to exclude when cloning objects */
    protected array $unsettableClone = ['id'];


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
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, GroupEntity::class);
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
