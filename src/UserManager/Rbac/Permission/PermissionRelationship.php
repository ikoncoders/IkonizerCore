<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Permission;

use IkonizerCore\UserManager\UserModel;
use IkonizerCore\UserManager\Model\UserRoleModel;
use IkonizerCore\UserManager\Rbac\Permission\PermissionModel;
use IkonizerCore\UserManager\Rbac\Model\RolePermissionModel;
use IkonizerCore\DataObjectLayer\DataRelationship\Relationships\ManyToMany;
use IkonizerCore\DataObjectLayer\DataRelationship\Relationships\OneToMany;
use IkonizerCore\Base\Contracts\BaseRelationshipInterface;

class PermissionRelationship extends UserModel implements BaseRelationshipInterface
{
    /**
     * self::class refers to this current class UserModel::class. Create the connection
     * between the different associated models and their pivoting table. In order to
     * establish a relationship. First we need to pass the type of possible 3 relationships
     * ManyToMany, OneToMany or OneToOne with the addRelationship method. Then add both
     * reference table within the table method then the pivot table to the pivot method.
     * Once we complete this we will have access to the methods within the type of relationships
     * we wish to use methods from.
     *
     * @return object
     */
    public function united(): object
    {
        return $this->setRelationship(ManyToMany::class)
            ->belongsToMany(RoleModel::class)->pivot(RolePermissionModel::class);
    }

}

