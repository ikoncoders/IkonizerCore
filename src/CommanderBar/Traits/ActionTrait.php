<?php
declare(strict_types=1);

namespace IkonizerCore\CommanderBar\Traits;

use IkonizerCore\IconLibrary;

trait ActionTrait
{

    private function actions(): string
    {

        if (isset($this->controller)) {
            if (in_array($this->controller->thisRouteAction(), $this->controller->commander->unsetAction())) {
                return '';
            }
        }

        $commander = PHP_EOL;
        $commander .= $this->commanderFiltering() ?? ''; // filtering
        $commander .= '<ul class="uk-iconnav">';
        $commander .= '<li>';
        $commander .= '<a style="margin-top:-5px;" href="/admin/' . $this->controller->thisRouteController() . '/log" uk-tooltip="View Log" class="uk-icon-link">';
        $commander .= IconLibrary::getIcon('file-text');
        $commander .= '</a>';
        $commander .= '</li>';
        $commander .= PHP_EOL;
        $commander .= '<li>';
        $commander .= '<a style="margin-top:-10px;" href="' . $this->actionPath() . '" class="uk-button uk-button-default uk-button-small">';
        $commander .= $this->actionButton();
        $commander .= '</a>';
        $commander .= '</li>';
        $commander .= PHP_EOL;
        $commander .= '</ul>';

        return $commander;
    }
    private function actionButton(): string
    {
        if (isset($this->controller)) {
            return match ($this->controller->thisRouteAction()) {
                'new', 'edit', 'show', 'hard-delete', 'preferences', 'privileges' => 'Listings',
                default => 'Add new'
            };
        }
    }

    private function actionPath(): string
    {
        if (isset($this->controller)) {
            return match ($this->controller->thisRouteAction()) {
                'new', 'edit', 'show', 'hard-delete', 'preferences', 'privileges' => '/' . $this->controller->thisRouteNamespace() . '/' . $this->controller->thisRouteController() . '/' . 'index',
                'index' => '/admin/' . $this->controller->thisRouteController() . '/new',
                default => 'javascript:history.back()'
            };
        }
    }


}
