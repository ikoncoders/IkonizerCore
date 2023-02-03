<?php

declare(strict_types=1);

namespace IkonizerCore\Base;

use IkonizerCore\Auth\Roles\PrivilegedUser;

class BaseProtectedRoutes
{

    public function __invoke()
    {
        $privilege = PrivilegedUser::getUser();
        if (!$privilege->hasPrivilege($permission . '_' . $controller->thisRouteController())) {
            $controller->flashMessage('Access Denied!', $controller->flashWarning());
            $controller->redirect('/admin/accessDenied/index');
        }
        return $this;

    }


}