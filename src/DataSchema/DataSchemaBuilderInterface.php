<?php

declare(strict_types=1);

namespace IkonizerCore\DataSchema;

interface DataSchemaBuilderInterface
{
    /**
     * Method which should be implemented when using this database schema component
     * We can call the database schema methods to build a table schema
     *
     * @return string
     */
    public function createSchema() : string;

}