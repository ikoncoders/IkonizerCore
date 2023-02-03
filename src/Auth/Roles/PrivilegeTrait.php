<?php
declare(strict_types=1);

namespace IkonizerCore\Auth\Roles;

trait PrivilegeTrait
{

    /**
     * return the current login user role as a capitalized string
     * @return string|false
     */
    public function getRole(): string|false
    {
        if ($this->roles) {
            foreach (array_keys($this->roles) as $key) {
                return $key;
            }
        }
        return false;
    }

    /**
     * Returns an array of the current log in user assigned permissions
     * @return array
     */
    public function getPermissions(): array
    {
        if ($this->roles) {
            foreach (array_values($this->roles) as $key => $value) {
                $value = (array)$value;
                foreach ($value as $permissionArray) {
                    return $permissionArray;
                }
            }
        }
    }

    public function getPermissionByRoleID(int $roleID)
    {
        $roles = Role::getRolePermissions($roleID);
        foreach ((array)$roles as $role) {
            return $role;
        }
    }


}
