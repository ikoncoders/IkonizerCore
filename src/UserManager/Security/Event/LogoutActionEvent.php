<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Security\Event;

use IkonizerCore\Base\BaseActionEvent;

class LogoutActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'ikonizerCore.usermanager.security.event.logout_action_event';
}
