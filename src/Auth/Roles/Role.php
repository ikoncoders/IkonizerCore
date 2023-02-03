<?php
declare(strict_types=1);

namespace IkonizerCore\Auth\Roles;

use IkonizerCore\UserManager\Rbac\Model\RolePermissionModel;
use IkonizerCore\UserManager\Rbac\Group\Model\GroupRoleModel;

class Role
{

    /** @var array  */
    public array $permissions;
    protected array $gRoles;

    /**
     * Role constructor.
     * @return void
     */
    protected function __construct()
    {
        $this->permissions = [];
    }

    /**
     * return a role object with associated permissions
     * @param $roleID
     * @return array
     */
    public static function getRolePermissions($roleID)
    {
        $role = new Role();
        $sql = "SELECT t2.permission_name FROM role_permission as t1 JOIN permissions as t2 ON t1.permission_id = t2.id WHERE t1.role_id = :role_id";
        $row = (new RolePermissionModel())
            ->getRepo()
            ->getEm()
            ->getCrud()
            ->rawQuery($sql, ['role_id' => $roleID], 'fetch_all');
        if ($row) {
            foreach ($row as $r) {
                $role->permissions[$r['permission_name']] = true;
            }
            return $role;
        }
    }

    public function relationship()
    {
        $sql = 'SELECT * FROM users, user_metadata, user_perferences, user_notes, user_role WHERE users.id = user_metadata.user_id AND user_preferences.user_id AND user_notes.user_id AND user_role.user_id';
    }

    /**
     * Check if a permission is set
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission)
    {
        return isset($this->permissions[$permission]);
    }

}
