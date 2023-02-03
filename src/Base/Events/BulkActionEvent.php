<?php

declare(strict_types=1);

namespace IkonizerCore\Base\Events;

use IkonizerCore\Base\BaseActionEvent;

class BulkActionEvent extends BaseActionEvent
{

    public const NAME = 'ikonizerCore.base.event_bulk.action.event';

}