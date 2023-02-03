<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Middleware\Before;

use Closure;
use IkonizerCore\Auth\Authorized;
use IkonizerCore\Middleware\BeforeMiddleware;

class LoginRequired extends BeforeMiddleware
{

    protected const MESSAGE = "<strong class=\"uk-text-danger\">Action Required: </strong>Please login for access.";

    /**
     * Requires basic login when entering protected routes
     *
     * @param Object $middleware - contains the BaseController object
     * @param Closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        if (!Authorized::grantedUser()) {
            $middleware->flashMessage(self::MESSAGE, $middleware->flashInfo());
            /* Hold the requested page so when the user logs in we can redirect them back */
            Authorized::rememberRequestedPage();
            $middleware->redirect('/login');
        }

        return $next($middleware);
    }
}
