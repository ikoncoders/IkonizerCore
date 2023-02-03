<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Query;

use IkonizerCore\DataObjectLayer\Query\Driver\QueryBuilderDriverInterface;

abstract class AbstractQueryBuilder implements QueryBuilderInterface
{
    private object $queryDriver;

    private array $databaseProps = [];


    public function __construct(QueryBuilderDriverInterface $queryBuilderDriver = null, array $databaseProps = [])
    {
        $this->queryDriver = $queryBuilderDriver;
        $this->databaseProps = $databaseProps;
    }

    public function getDatabaseProps(): array
    {
        return $this->databaseProps;
    }

    public function getQueryDriver()
    {
        return $this->queryDriver;
    }

    
}