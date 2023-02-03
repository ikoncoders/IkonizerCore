<?php
declare(strict_types=1);

namespace IkonizerCore\CommanderBar\Commander;

use IkonizerCore\IconLibrary;
use IkonizerCore\Utility\Stringify;
use IkonizerCore\CommanderBar\CommanderBar;

class CommanderNotification
{

    public function notifications(object $comm): string
    {
        if (isset($comm->controller)) {
            if (in_array($comm->controller->thisRouteAction(), $comm->controller->commander->unsetNotification())) {
                return '';
            }
        }
        //$off = '<ion-icon name="notifications-off-outline"></ion-icon>';
        $command = '<li class="uk-active">';
        $command .= '<a href="javascript:void()" class="uk-text-muted">';
        // $command .= '<ion-icon size="large" name="notifications-outline"></ion-icon>';
        $command .= sprintf('<a href="#">%s</a>', IconLibrary::getIcon('bell', 1.5));

        $command .= '<span><sup class="uk-badge">3</sup></span>';
        $command .= '</a>';
        $command .= '</li>';

        return $command;
    }

}