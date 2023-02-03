<?php
declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\ListsWidget;

use IkonizerCore\Widget\Widget;
use IkonizerCore\IconLibrary; 
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class ListsWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'lists_widget';

    /**
     * Render the widget
     *
     * @param string|null $widgetName
     * @param ClientRepositoryInterface $clientRepo
     * @param BaseWidget $baseWidget
     * @return string
     */
    public static function render(?string $widgetName = null, ClientRepositoryInterface $clientRepo, BaseWidget $baseWidget, mixed $widgetData = null): string
    {
        if ($widgetName === self::WIDGET_NAME) {
            return $baseWidget::card(function($base) use ($widgetData) {

                $output = '';
                if (is_array($widgetData) && count($widgetData) > 0) {
                    foreach ($widgetData as $key => $value) {
                        $output .= sprintf(
                            '   
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-auto">
                                        <a href="%s" class="uk-link-reset">%s</a>
                                    </div>
                                    <div class="uk-width-expand">
                                        <h3 class="uk-card-title uk-text-bolder uk-margin-remove-bottom">%s</h3>
                                        <p class="uk-text-meta uk-margin-remove-top uk-text-%s">
                                            %s
                                        </p>
                                    </div>
                                </div>
                            </div>
                            ',
                            $value['path'],
                            IconLibrary::getIcon($value['icon'], 2.2),
                            $key,
                            $value['label'] ? $value['label'] : 'secondary',
                            self::resolveDesc($value)
                        );
        
                    }

                    return $output;
                }
            },
            ''
            );
        }        
    }

    private static function resolveDesc(array $value = [])
    {
        if (is_array($value['desc']) && count($value['desc']) > 0) {
            foreach ($value['desc'] as $desc) {
                return sprintf('<span>%s</span>', $desc);
            }
        }
    }

}
