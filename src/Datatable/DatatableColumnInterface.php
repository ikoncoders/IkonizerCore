<?php

declare(strict_types=1);

namespace IkonizerCore\Datatable;

interface DatatableColumnInterface
{

    /**
     * Returns an array of database columns that matches the its entity and schema
     *
     * @param array $dbColumns
     * @param object|null $callingController
     * @return array
     */
    public function columns(array $dbColumns, ?object $callingController = null) : array;

}