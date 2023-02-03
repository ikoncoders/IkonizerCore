<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Traits;

use IkonizerCore\UserManager\UserController;
use IkonizerCore\UserManager\Rbac\Permission\PermissionModel;
use IkonizerCore\Auth\Authorized;
use IkonizerCore\Auth\Roles\PrivilegedUser;
use IkonizerCore\Base\BaseModel;
use IkonizerCore\Utility\Stringify;
use ReflectionMethod;
use ReflectionClass;
use IkonizerCore\Base\Traits\BaseReflectionTrait;
use IkonizerCore\Base\BaseProtectedRoutes;

trait ControllerPrivilegeTrait
{

    use BaseReflectionTrait;

    public function assignedRoutesToPrivileges(string $method)
    {
        /* Get methods from the calling controller class */
        $reflectionMethods = $this->getMethodNames();
        if (count($reflectionMethods) > 0) {
            if ($method === $reflectionMethods['name']) {
                return $method;
            }
        }
    }

    /**
     * @return string
     */
    private function getClassNamespace(): string
    {
        $routeParams = $this->getRouteParams();
        $className = Stringify::studlyCaps($routeParams['controller'] . 'Controller');
        if (isset($routeParams['namespace'])) {
            $namespace = "\App\Controller\Admin\\" . $className;
        } else {
            $namespace = "\App\Controller\\" . $className;
        }

        return $namespace;

    }

    /**
     * Get a reflection of the current controller class
     * @throws ReflectionException
     * return object
     */
    private function getReflection(): object
    {
        return new ReflectionClass($this->getClassNamespace());
    }

    /**
     * Return an array of reflection methods
     * @return array
     */
    private function getReflectionMethods(): array
    {
        $methods = $this->getReflection()->getMethods(ReflectionMethod::IS_PROTECTED);
        if (is_array($methods) && count($methods) > 0) {
            return $methods;
        }
    }

    private function getMethodNames()
    {
        $methods = $this->getReflectionMethods();
        if (count($methods) > 0) {
            foreach ($methods as $method) {
                return (array)$method;
            }
        }
    }

    public function checkPermission()
    {
        /* get all permission */
        $permissions = $this->getPermissions();
        $permissionRoutes = $this->getPermissionRoutes();
        if ($permissions) {
            $permissionArray = [];
            foreach ($permissions as $key => $permission) {
                $permissionArray = $permission;
            }
            $className = Stringify::studlyCaps($permissionRoutes['controller'] . 'Controller');
            if (isset($permissionRoutes['namespace'])) {
                $namespace = "\App\Controller\Admin\\" . $className;
            } else {
                $namespace = "\App\Controller\\" . $className;
            }

            $reflection = new ReflectionClass($namespace);
            $methods = $reflection->getMethods(ReflectionMethod::IS_PROTECTED);
            if (count($methods) > 0) {
                foreach ($methods as $method) {
                    foreach ($method as $name) {
                        if (str_contains($name, $permissionRoutes['action'])) {
                            $permName = $permissionRoutes['action'] . '_' . $permissionRoutes['controller'];
                            $role = PrivilegedUser::getUser();
                            if ($role) {
                                if (!$role->hasPrivilege($permName)) {
                                    if (!in_array($permName, $role->getPermissions())) {
                                        $_className = new $className;
                                        $_className->flashMessage('You are not authorized to enter this entire', $_className->flashWarning());
                                        $_className->redirect(Authorized::getReturnToPage());
                                    }
                                }
                            }
                        }
                    }

                }
            }
        }
        /* assign a permission to a matching route */

        /* check a user has the permission to access the route */
    }

    /**
     * Return an array of the current route parameters
     * @return mixed
     */
    private function getRouteParams()
    {
        return $this->routeParams;
    }

    /**
     * Return the application permissions from the database
     * @return array
     */
    private function getPermissions()
    {
        if (class_exists($permissions = PermissionModel::class)) {
            $results = new $permissions();
            if ($results instanceof BaseModel) {
                $perms = $results->getRepo()->findAll();
                if (is_array($perms) && count($perms) > 0) {
                    return $perms;
                }
            }
        }
    }

    /**
     *
     */
    public function getAllMethodPermissions()
    {
    }

}
