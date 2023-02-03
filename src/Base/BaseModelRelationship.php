<?php

declare(strict_types=1);

namespace IkonizerCore\Base;

use IkonizerCore\Base\BaseApplication;
use IkonizerCore\DataObjectLayer\DataRelationship\DataRelationalInterface;
use IkonizerCore\DataObjectLayer\DataRelationship\Exception\DataRelationshipInvalidArgumentException;

class BaseModelRelationship implements DataRelationalInterface
{

    private BaseModel $baseModel;

    public function __construct(BaseModel $baseModel)
    {
        $this->baseModel = $baseModel;
    }

    /**
     * Build relationships between tables
     *
     * @param string $relationshipType
     * @return object
     */
    public function setRelationship(string $relationshipType): object
    {
        $relationship = BaseApplication::diGet($relationshipType);
        if (!$relationship instanceof DataRelationalInterface) {
            throw new DataRelationshipInvalidArgumentException('');
        }
        return $relationship;
    }

    /**
     * Returns the associated relationship objects
     * @param string $relationships
     * @return object
     */
    public function getRelationship(string $relationships): object
    {
        $relationshipObject = BaseApplication::diGet($relationships);
        // if (!$relationshipObject instanceof BaseRelationshipInterface) {
        //     throw new BaseInvalidArgumentException('');
        // }
        return $relationshipObject->united();
    }


}

