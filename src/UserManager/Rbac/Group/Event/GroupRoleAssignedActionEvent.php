<?php

declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Group\Event;

use IkonizerCore\Base\BaseActionEvent;

class GroupRoleAssignedActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'ikonizerCore.usermanager.rbac.group.event.group_role_assigned_action_event';
}

