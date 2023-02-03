<?php


declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\WebsiteTraffic;

use IkonizerCore\Widget\Widget;
use IkonizerCore\IconLibrary;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class WebsiteTrafficWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'website_traffic_widget';

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
            return $baseWidget::card(function($base) {

                return sprintf(
                    '   
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                %s
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-text-bolder uk-margin-remove-bottom">%s</h3>
                                <p class="uk-text-meta uk-margin-remove-top">
                                    <time datetime="%s">%s</time>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        %s
                    </div>
                    ',
                    IconLibrary::getIcon('clock', 3.5),
                    'Website Traffic',
                    '2016-04-01T19:00',
                    'Most popular traffic coming from Google',
                    'The total number of sessions within the date range. It is the period time a user is actively engaged with your website, page or app, etc.'
                );
            },
            ''
            );
        }        
    }

}
