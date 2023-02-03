<?php

declare(strict_types=1);

namespace IkonizerCore\Base\EventSubscriber;

use IkonizerCore\EventDispatcher\EventSubscriberInterface;

class BeforeRenderActionSubscriber implements EventSubscriberInterface
{

    /**
     * Subscribe multiple listeners to listen for the BeforeRenderActionEvent. This will fire
     * each time a the render method or the viewing  template is called. Listeners can then perform
     * additional tasks on that return object.
     * @return array
     */

    public static function getSubscribedEvents(): array
    {
        return [
            //BeforeRenderActionEvent::NAME => []
        ];
    }


}
