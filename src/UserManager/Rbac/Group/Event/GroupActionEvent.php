<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Group\Event;

use IkonizerCore\Base\BaseActionEvent;

class GroupActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'ikonizerCore.usermanager.rbac.group.event.group_action_event';
}
