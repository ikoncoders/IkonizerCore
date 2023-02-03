<?php

declare(strict_types=1);

namespace IkonizerCore\Base\Middlewares;

use IkonizerCore\Middleware\BeforeMiddleware;

class Error404 extends BeforeMiddleware
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
    }
}

