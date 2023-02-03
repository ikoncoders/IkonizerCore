<?php

declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets;

use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

interface WidgetBuilderInterface
{
    /**
     * Render the widget
     *
     * @param string|null $widgetName - the name of the rendering widget
     * @param ClientRepositoryInterface $clientRepo - database access to access the specified table
     * @param BaseWidget $baseWidget - contains standard method to aiding in constructing a widget
     * @param mixed $widgetData - template specific data passed in
     * @return string - Should always return a formatted string
     */
    public static function render(?string $widgetName = null, ClientRepositoryInterface $clientRepo, BaseWidget $baseCard, mixed $widgetData = null): string;

}
