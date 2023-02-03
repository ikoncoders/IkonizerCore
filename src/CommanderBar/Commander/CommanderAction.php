<?php
declare(strict_types=1);

namespace IkonizerCore\CommanderBar\Commander;

use IkonizerCore\CommanderBar\CommanderBar;
use IkonizerCore\IconLibrary;
use IkonizerCore\Utility\Stringify;

class CommanderAction
{

    public function actions(object $comm): string
    {
        if (isset($comm->controller)) {
            if (in_array($comm->controller->thisRouteAction(), $comm->controller->commander->unsetAction())) {
                return '';
            }
        }
        $command = PHP_EOL;
        $command .= $comm->commanderFiltering() ?? ''; // filtering
        $command .= '<ul class="uk-iconnav">';
        $command .= '<li>';
        // $command .= '<a style="margin-top:-10px;" href="/admin/' . $comm->controller->thisRouteController() . '/log" uk-tooltip="View Log" class="uk-icon-link">';
        $command .= IconLibrary::getIcon('file-text', 1);
        $command .= '</a>';
        $command .= '</li>';
        $command .= PHP_EOL;
        $command .= '<li>';
        $command .= '<a href="' . $comm->actionPath() . '" uk-tooltip="Go Back" class="uk-button uk-button-primary uk-button-small uk-link-reset uk-link-toggle">';
        $command .= $comm->actionButton();
        $command .= '</a>';
        $command .= '</li>';
        $command .= PHP_EOL;
        $command .= '</ul>';

        return $command;
    }

}