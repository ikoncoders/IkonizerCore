<?php


declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\DataRelationship;

/**
 * Both tables can have only one record on each side of the relationship.
 * each primary key value relates to none or only one record in the related table
 */
interface DataRelationshipInterface
{
    /**
     * Undocumented function
     *
     * @param string $tableLeft
     * @param string $tableRight
     * @return DataRelationshipInterface
     */
    public function table(string $tableLeft, ?string $tableRight = null): self;

    /**
     * Undocumented function
     *
     * @param string $tablePivot
     * @return DataRelationshipInterface
     */
    public function pivot(string $tablePivot): self;

}