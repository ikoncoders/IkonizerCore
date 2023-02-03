<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Schema;

use IkonizerCore\UserManager\Model\RoleModel;
use IkonizerCore\UserManager\UserModel;
use IkonizerCore\UserManager\Model\UserRoleModel;
use IkonizerCore\DataSchema\DataSchema;
use IkonizerCore\DataSchema\DataSchemaBlueprint;
use IkonizerCore\DataSchema\DataSchemaBuilderInterface;

class UserRoleSchema implements DataSchemaBuilderInterface
{

    /** @var object - $schema for chaining the schema together */
    protected object $schema;
    /** @var object - provides helper function for quickly adding schema types */
    protected object $blueprint;
    /** @var object - the database model this schema is linked to */
    protected object $userRoleModel;
    /** @var string */
    private const FIRST_COLUMN = 'user_id';
    /** @var string */
    private const SECOND_COLUMN = 'role_id';

    /**
     * Main constructor class. Any typed hinted dependencies will be autowired. As this
     * class can be inserted inside a dependency container
     *
     * @param DataSchema $schema
     * @param DataSchemaBlueprint $blueprint
     * @param UserRoleModel $userRoleModel
     * @return void
     */
    public function __construct(DataSchema $schema, DataSchemaBlueprint $blueprint, UserRoleModel $userRoleModel)
    {
        $this->schema = $schema;
        $this->blueprint = $blueprint;
        $this->userRoleModel = $userRoleModel;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function createSchema(): string
    {
        return $this->schema
            ->schema()
            ->table($this->userRoleModel)
            ->row($this->blueprint->int(self::FIRST_COLUMN, 10))
            ->row($this->blueprint->int(self::SECOND_COLUMN, 10))
            ->build(function ($schema) {
                return $schema
                    ->setKey([self::FIRST_COLUMN, self::SECOND_COLUMN])
                    ->setConstraints(
                        function ($trait) {
                            $constraint = $trait->addModel(UserModel::class)
                                ->foreignKey(self::FIRST_COLUMN)
                                ->on($trait->getModel()->getSchema())
                                ->reference($trait->getModel()->getSchemaID())
                                ->cascade(true, true)->add();
                            $constraint .= $trait->addModel(RoleModel::class)
                                ->foreignKey(self::SECOND_COLUMN)
                                ->on($trait->getModel()->getSchema())
                                ->reference($trait->getModel()->getSchemaID())
                                ->cascade(true, true)->add();
                            return $constraint;
                        }
                    );
            });
    }
}
