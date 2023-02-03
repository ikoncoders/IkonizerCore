<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Security\Middleware\Before;

use IkonizerCore\UserManager\UserModel;
use Closure;
use IkonizerCore\Middleware\BeforeMiddleware;

class isUserAccountActivated extends BeforeMiddleware
{

    /**
     * Prevent login access if a user account is either pending, lock or suspended.
     * Only active account user will be allowed in.
     *
     * @param object $middleware - contains the BaseController object
     * @param closure $next
     * @return void
     */
    public function middleware(object $middleware, Closure $next)
    {
        $message = '';
        if ($email = $middleware->request->handler()->get('email')) {
            if (isset($email)) {
                $user = (new UserModel())->getRepo()->findObjectBy(['email' => $email]);
                if (is_null($user)) {
                    $middleware->flashMessage('Account not found.', $middleware->flashWarning());
                    $middleware->redirect('/login');
                }
//                $message = match ($user->status) {
//                    'pending' => 'Account not activated.',
//                    'lock' => 'Your account is locked. Please contact support for more information',
//                    'suspended' => 'Your account is suspended.',
//                    'active' => 'Welcome',
//                };
//                $middleware->flashMessage($message, $middleware->flashWarning());
//                $middleware->redirect('/login');
            }
        }

        return $next($middleware);
    }
}
