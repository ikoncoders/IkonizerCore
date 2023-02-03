<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Registration\Event;

use IkonizerCore\Base\BaseActionEvent;

class RegistrationActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'IkonizerCore.usermanager.registration.event.registration_action_event';
}
