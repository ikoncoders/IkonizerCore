<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\QueryBuilder;

use Exception;

interface QueryBuilderInterface
{

    /**
     * Insert query string
     *
     * @return string
     * @throws Exception
     */
    public function insertQuery() : string;

    /**
     * Select query string
     *
     * @return string
     * @throws Exception
     */
    public function selectQuery() : string;

    /**
     * Update query string
     *
     * @return string
     * @throws Exception
     */
    public function updateQuery() : string;

    /**
     * Delete query string
     *
     * @return string
     * @throws Exception
     */
    public function deleteQuery() : string;

    /**
     * Search|Select query string
     *
     * @return string
     * @throws Exception
     */
    public function searchQuery() : string;

    /**
     * Raw query string
     *
     * @return string
     * @throws Exception
     */
    public function rawQuery() : string;

}
