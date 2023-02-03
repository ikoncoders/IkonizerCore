<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Event;

use IkonizerCore\Base\BaseActionEvent;

class RolePermissionAssignedActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'ikonizerCore.usermanager.rbac.event.role_permission_assigned_action_event';
}

