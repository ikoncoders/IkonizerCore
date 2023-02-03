<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Permission\Event;

use IkonizerCore\Base\BaseActionEvent;

class PermissionActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'magmacore.usermanager.rbac.permission.event.permission_action_event';
}
