<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Role;

use IkonizerCore\DataSchema\DataSchema;
use IkonizerCore\DataSchema\DataSchemaBlueprint;
use IkonizerCore\DataSchema\DataSchemaBuilderInterface;

class RoleSchema implements DataSchemaBuilderInterface
{

    /** @var object - $schema for chaining the schema together */
    protected object $schema;
    /** @var object - provides helper function for quickly adding schema types */
    protected object $blueprint;
    /** @var object - the database model this schema is linked to */
    protected object $roleModel;

    /**
     * Main constructor class. Any typed hinted dependencies will be autowired. As this
     * class can be inserted inside a dependency container
     *
     * @param DataSchema $schema
     * @param DataSchemaBlueprint $blueprint
     * @param RoleModel $roleModel
     * @return void
     */
    public function __construct(DataSchema $schema, DataSchemaBlueprint $blueprint, RoleModel $roleModel)
    {
        $this->schema = $schema;
        $this->blueprint = $blueprint;
        $this->roleModel = $roleModel;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function createSchema(): string
    {
        return $this->schema
            ->schema()
            ->table($this->roleModel)
            ->row($this->blueprint->autoID())
            ->row($this->blueprint->varchar('role_name', 64))
            ->row($this->blueprint->varchar('role_description', 190))
            ->row($this->blueprint->int('created_byid', 10, false))
            ->row($this->blueprint->datetime('created_at', false))
            ->row($this->blueprint->datetime('modified_at', true, 'null', 'on update CURRENT_TIMESTAMP'))
            ->build(function ($schema) {
                return $schema
                    ->addPrimaryKey($this->blueprint->getPrimaryKey())
                    ->setUniqueKey(['role_name'])
                    ->addKeys();
            });
    }
}
