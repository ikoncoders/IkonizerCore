<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Security\Middleware\Before;

use Closure;
use IkonizerCore\Auth\Authorized;
use IkonizerCore\Middleware\BeforeMiddleware;

class isAlreadyLogin extends BeforeMiddleware
{

    /**
     * Prevent access to the login form is the user is already logged.
     * as this action doesn't need doing again
     *
     * @param object $middleware - contains the BaseController object
     * @param closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        if (
            $middleware->thisRouteController() === 'security' && 
            $middleware->thisRouteAction() === 'index') {
            $userID = $middleware->getSession()->get('user_id');
            if (isset($userID) && $userID !== 0) {
                $middleware->flashMessage(sprintf('%s You are already logged in.', '<strong class=\"uk-text-danger\">Action Rejected: </strong>'), $middleware->flashInfo());
                $middleware->redirect(Authorized::getReturnToPage());
            }
        }
        return $next($middleware);
    }

}