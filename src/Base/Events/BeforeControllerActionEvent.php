<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Events;

use IkonizerCore\Base\BaseActionEvent;

class BeforeControllerActionEvent extends BaseActionEvent
{

    public const NAME = 'ikonizerCore.base.event_before_controller_action_event';

}