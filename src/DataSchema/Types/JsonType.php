<?php

declare(strict_types=1);

namespace IkonizerCore\DataSchema\Types;

use IkonizerCore\DataSchema\DataSchemaBaseType;
use IkonizerCore\DataSchema\DataSchemaTypeInterface;

class JsonType extends DataSchemaBaseType implements DataSchemaTypeInterface
{

    /** @var array - Json schema types */
    protected array $types = [
        'json'
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