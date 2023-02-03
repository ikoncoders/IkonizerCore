<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Middleware\Before;

use Closure;
use IkonizerCore\Auth\Authorized;
use IkonizerCore\Auth\Roles\PrivilegedUser;
use IkonizerCore\Auth\Roles\Roles;
use IkonizerCore\Middleware\BeforeMiddleware;

class AdminAuthentication extends BeforeMiddleware
{
    /**
     * Prevent unauthorized access to the administration panel. Only users with specific
     * privileges can access the admin area.
     *
     * @param Object $middleware
     * @param Closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        $user = PrivilegedUser::getUser();
        if (!$user->hasPrivilege('have_admin_access')) {
            $middleware->flashMessage("<strong class=\"uk-text-danger\">Access Denied </strong>Sorry you need the correct privilege to access this area.", $middleware->flashInfo());
            $middleware->redirect(Authorized::getReturnToPage());
        }

        return $next($middleware);
    }
}
