<?php


declare(strict_types=1);

namespace IkonizerCore\Widget;

interface WidgetInterface
{
    /**
     * Render the final widget to the client browser
     *
     * @param mixed $widgetData - Data which can be pass back to the widget component
     * @return mixed
     */
    public function renderWidget(mixed $widgetData = null): mixed;

}