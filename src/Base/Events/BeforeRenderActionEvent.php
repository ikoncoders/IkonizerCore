<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Events;

use IkonizerCore\EventDispatcher\Event;

class BeforeRenderActionEvent extends Event
{
    public const NAME = 'ikonizerCore.base.event_before_render_action_event';

}