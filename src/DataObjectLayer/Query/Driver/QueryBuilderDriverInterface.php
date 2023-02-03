<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Query\Driver;

interface QueryBuilderDriverInterface
{

    public function insertQueryDriver(): self;
    public function selectQueryDriver(): self;
    public function updateQueryDriver(): self;
    public function deleteQueryDriver(): self;
    public function rawQueryDriver(): self;

}
