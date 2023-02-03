<?php

declare(strict_types=1);

namespace IkonizerCore\Asministrator\Dashboard\Event;

use IkonizerCore\Base\BaseActionEvent;

class DashboardActionEvent extends BaseActionEvent
{

    /** @var string - name of the event */
    public const NAME = 'app.event.dashboard_action_event';

}
