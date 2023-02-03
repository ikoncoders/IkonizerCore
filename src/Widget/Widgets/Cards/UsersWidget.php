<?php
declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\Cards;

use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;
use IkonizerCore\Widget\Widgets\Members\MembersWidgetTrait;

class UsersWidget extends Widget implements WidgetBuilderInterface
{   

    use MembersWidgetTrait;

    /* @var string the widget name */
    public const WIDGET_NAME = 'users_widget';
    private const LABEL = 'Today\'s Gained';

    /**
     * @inheritDoc
     */
    public static function render(?string $widgetName = null, ClientRepositoryInterface $clientRepo, BaseWidget $baseWidget, mixed $widgetData = null): string
    {
        if ($widgetName === self::WIDGET_NAME) {            
            return $baseWidget::card(function($base) use ($widgetData, $clientRepo) {
                $total = self::totalUsers($clientRepo->getClientCrud());
                return sprintf(
                    '            
                    <div class="uk-clearfix">
                        <div class="uk-float-left">
                            <h3 class="uk-card-title uk-text-bolder uk-margin-remove">%s</h3>
                            <span class="uk-margin-remove uk-text-meta uk-text-wrap">%s</span>
        
                            <span class="uk-text-small">
                                %s
                                <span class="uk-text-warning uk-margin-left">
                                    %s <span uk-icon="icon: triangle-%s"></span>
                            </span>
                            </span>
        
                        </div>
                        <div class="uk-float-right">
                            <div id="users_widget"></div>
                        </div>
                        
                    </div>
                    %s
                    ',
                    'Members 12.7k',
                    self::LABEL,
                    '+263',
                    '8%',
                    'down',
                    self::script($clientRepo)
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
    private static function script(object $clientRepo): string
    {
        $pending = self::totalPendingUsers($clientRepo->getClientCrud()) ?? 0;
        $active = self::totalActiveUsers($clientRepo->getClientCrud()) ?? 0;
        $trash = self::totalTrashUsers($clientRepo->getClientCrud()) ?? 0;
        $total = self::totalUsers($clientRepo->getClientCrud());
        $locked = self::totalLockedUsers($clientRepo->getClientCrud());

        $output = '
        <script>
        $("#users_widget").sparkline([' . $total . ', ' . $active . ', ' . $pending . ', -' . $trash . ', -' . $locked . '], {
            type: "bar",
            height: "60",
            barWidth: "10",
            barColor: "#222222"
        });
    
        </script>
        ';

        return $output;
    }

}
