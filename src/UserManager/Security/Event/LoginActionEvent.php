<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Security\Event;

use IkonizerCore\Base\BaseActionEvent;

class LoginActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'IkonizerCore.usermanager.security.event.login_action_event';
}
