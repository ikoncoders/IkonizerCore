<?php

declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\Cards;

use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class ContentWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'content_widget';


    /**
     * @inheritDoc
     */
    public static function render(?string $widgetName = null, ClientRepositoryInterface $clientRepo, BaseWidget $baseWidget, mixed $widgetData = null): string
    {
        if ($widgetName === self::WIDGET_NAME) {
            return $baseWidget::card(function($base) {
                return sprintf(
                    '      
                    <div class="uk-clearfix">
                        <div class="uk-float-left">
                            <h3 class="uk-card-title uk-text-bolder uk-margin-remove">%s</h3>
                            <span class="uk-margin-remove uk-text-meta">%s</span>
                            <span class="statistics-number">
                                %s
                                <span class="uk-label uk-label-danger">
                                    %s <span class="ion-arrow-%s"></span>
                            </span>
                            </span>
        
                        </div>
                        <div class="uk-float-right">
                            <div id="todays_visit_bar"></div>
                        </div>
                    </div>
          
                    ',
                    'Content',
                    '30min ago',
                    '1.4k',
                    '8%',
                    'down-c',
                );
            },
            'default'
            );
        }        
    }

}
