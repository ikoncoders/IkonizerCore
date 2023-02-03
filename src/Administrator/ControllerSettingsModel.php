<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator;

use IkonizerCore\Base\AbstractBaseModel;
use IkonizerCore\Administrator\ControllerSettingsEntity;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;

class ControllerSettingsModel extends AbstractBaseModel
{

    /** @var string */
    protected const TABLESCHEMA = 'controller_settings';
    /** @var string */
    protected const TABLESCHEMAID = 'id';
    public const COLUMN_STATUS = [];


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
        parent::__construct(self::TABLESCHEMA, self::TABLESCHEMAID, ControllerSettingsEntity::class);
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

