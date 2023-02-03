<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Query;

use IkonizerCore\DataObjectLayer\Query\Driver\QueryBuilderDriverInterface;
use IkonizerCore\DataObjectLayer\Query\Exception\QueryBuilderInvalidArgumentException;

class QueryBuilderFactory
{

    public function create(string $QueryDriverString, array $databaseProps = []): QueryBuilderInterface {
        $QueryDriverObject = new $QueryDriverString($databaseProps);
        if (!$QueryDriverObject instanceof QueryBuilderDriverInterface) {
            throw new QueryBuilderInvalidArgumentException(
                $QueryDriverString . ' is not a valid session storage object.'
            );
        }

        return new QueryBuilder($QueryDriverObject);
    }
    
}