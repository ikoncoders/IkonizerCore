<?php

declare(strict_types=1);

namespace IkonizerCore\Auth\Schema;

use IkonizerCore\Auth\Model\RememberedLoginModel;
use IkonizerCore\DataSchema\DataSchema;
use IkonizerCore\DataSchema\DataSchemaBlueprint;
use IkonizerCore\DataSchema\DataSchemaBuilderInterface;

class RememberedLoginSchema implements DataSchemaBuilderInterface
{

    /** @var object - $schema for chaining the schema together */
    protected object $schema;
    /** @var object - provides helper function for quickly adding schema types */
    protected object $blueprint;
    /** @var object - the database model this schema is linked to */
    protected object $rememberedLogin;

    /**
     * Main constructor class. Any typed hinted dependencies will be autowired. As this
     * class can be inserted inside a dependency container
     *
     * @param DataSchema $schema
     * @param DataSchemaBlueprint $blueprint
     * @param RememberedLoginModel $rememberedLogin
     * @return void
     */
    public function __construct(DataSchema $schema, DataSchemaBlueprint $blueprint, RememberedLoginModel $rememberedLogin)
    {
        $this->schema = $schema;
        $this->blueprint = $blueprint;
        $this->rememberedLogin = $rememberedLogin;
    }

    /**
     * @inheritdoc
     * @return string
     */
    public function createSchema(): string
    {
        return $this->schema
            ->schema()
            ->table($this->rememberedLogin)
            ->row($this->blueprint->autoID())
            ->row($this->blueprint->varchar('token_hash', 64))
            ->row($this->blueprint->datetime('expires_at', false, 'none'))
            ->build(function ($schema) {
                return $schema
                    ->addPrimaryKey($this->blueprint->getPrimaryKey())
                    ->setUniqueKey(['token_hash'])
                    ->addKeys();
            });
    }
}
