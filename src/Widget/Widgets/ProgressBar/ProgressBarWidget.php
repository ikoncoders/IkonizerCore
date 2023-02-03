<?php


declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\ProgressBar;

use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class ProgressBarWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'progress_bar_widget';
    private const LABEL = '';


    /**
     * @inheritDoc
     */
    public static function render(?string $widgetName = null, ClientRepositoryInterface $clientRepo, BaseWidget $baseWidget, mixed $widgetData = null): string
    {
        if ($widgetName === self::WIDGET_NAME) {
            return $baseWidget::blankWrapper(function($base) use ($widgetData, $clientRepo) {
                if (is_array($widgetData) && count($widgetData) > 0) {
                    $output = '';
                    foreach ($widgetData as $key => $value) {
                        $output .= sprintf(
                            '
                            <div>
                                <span class="uk-text-small %s">%s <small> (%s)</small></span>
                                <progress class="uk-progress %s" value="%s" max="%s"></progress>
                            </div>
                            ',
                            $key,
                            $value['title'],
                            $value['quantity'],
                            $value['progress'],
                            $value['value'],
                            $value['max'] ? $value['max'] : 100
                        );
                    }

                    return $output;
                }
            });
        }        
    }

}
