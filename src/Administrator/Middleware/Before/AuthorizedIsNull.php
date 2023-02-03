<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Middleware\Before;

use Closure;
use IkonizerCore\Auth\Authorized;
use IkonizerCore\Middleware\BeforeMiddleware;

class AuthorizedIsNull extends BeforeMiddleware
{

    /**
     * Redirect to login if authorized object is null. As if you're not
     * authorized then access cannot be granted.
     *
     * @param Object $middleware - contains the BaseController object
     * @param Closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        $authorized = Authorized::grantedUser();
        if (is_null($authorized)) {
            $middleware->redirect('/login');
        }
        return $next($middleware);
    }

}