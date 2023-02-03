<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Event;

use IkonizerCore\Base\BaseActionEvent;

class RolePermissionActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'ikonizerCore.usermanager.rbac.event.role_permission_action_event';
}

