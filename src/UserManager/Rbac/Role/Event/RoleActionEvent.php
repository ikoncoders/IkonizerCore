<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Role\Event;

use IkonizerCore\Base\BaseActionEvent;

class RoleActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'IkonizerCore.usermanager.rbac.role.event.role_action_event';
}
