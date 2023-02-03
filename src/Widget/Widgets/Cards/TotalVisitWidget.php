<?php

declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\Cards;

use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\Widget\Widgets\BaseWidget;
 use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;

class TotalVisitWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'total_visit_widget';
    private const LABEL = 'Visitor Sessions';


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
                            <span class="uk-text-small">
                                %s
                                <span class="uk-text-success uk-margin-left">
                                    %s <span uk-icon="icon: triangle-%s"></span>
                            </span>
                            </span>
        
                        </div>
                        <div class="uk-float-right">
                            <div id="visitor_sessions"></div>
                        </div>
                    </div>
                    %s
                    ',
                    self::LABEL,
                    'Total visits today',
                    '1.4k',
                    '15.9%',
                    'up',
                    self::script()
                );
            },
            'default'
            );
        }        
    }

    /**
     * Returns the sparklines graph for this card
     *
     * @param object $clientRepo
     * @return string
     */
    private static function script(): string
    {
        $output = '
        <script>
        $("#visitor_sessions").sparkline([1432, 874, 972, 643], {
            type: "bar",
            height: "60",
            barWidth: "10",
            barColor: "#FF4444"
        });
    
        </script>
        ';

        return $output;
    }


}
