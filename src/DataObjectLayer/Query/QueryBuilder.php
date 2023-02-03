<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Query;

use IkonizerCore\DataObjectLayer\Query\AbstractQueryBuilder;
use IkonizerCore\DataObjectLayer\Query\Driver\QueryBuilderDriverInterface;

class QueryBuilder extends AbstractQueryBuilder
{

    protected ?QueryBuilderDriverInterface $queryDriver = null;
    protected array $databaseProps = [];

    public function __construct(QueryBuilderDriverInterface $queryBuilderDriver = null, array $databaseProps = [])
    {
        parent::__construct($queryBuilderDriver, $databaseProps);
    }


    public function insertQuery(): string
    {
        return $this->getQueryDriver()->insertQueryDriver();
    }

    public function selectQuery(): string
    {
        return $this->getQueryDriver()->selectQueryDriver();

    }

    public function updateQuery(): string
    {
        return $this->getQueryDriver()->updateQueryDriver();

    }

    public function deleteQuery(): string
    {
        return $this->getQueryDriver()->deleteQueryDriver();

    }
    
    public function rawQuery(): string
    {
        return $this->getQueryDriver()->rawQueryDriver();

    }


}