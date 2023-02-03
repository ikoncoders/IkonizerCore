<?php

declare(strict_types=1);

namespace IkonizerCore\DataSchema\Types;

use IkonizerCore\DataSchema\DataSchemaBaseType;
use IkonizerCore\DataSchema\DataSchemaTypeInterface;

class NumericType extends DataSchemaBaseType implements DataSchemaTypeInterface
{

    /** @var array - integre schema types */
    protected array $types = [
        'tinyint',
        'smallint',
        'mediumint',
        'bigint',
        'decimal',
        'float',
        'real',
        'double',
        'bit',
        'boolean',
        'serial',
        'int'
    ];

    /**
     * Undocumented function
     *
     * @param array $row
     */
    public function __construct(array $row = [])
    {
        parent::__construct($row, $this->types);
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function render(): string
    {
        return parent::render();
    }


}