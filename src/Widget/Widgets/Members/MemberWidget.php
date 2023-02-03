<?php
declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\Members;

use IkonizerCore\IconLibrary;
use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;
use IkonizerCore\Numbers\Number;
use IkonizerCore\Utility\Utilities;

class MemberWidget extends Widget implements WidgetBuilderInterface
{   

    use MembersWidgetTrait;

    /* @var string the widget name */
    public const WIDGET_NAME = 'member_widget';

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
            return $baseWidget::card(function($base) use ($clientRepo, $widgetData) {

                $total = self::totalUsers($clientRepo->getClientCrud());
                return sprintf(
                    '   
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                %s
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-text-bolder uk-margin-remove-bottom">%s Users</h3>
                                <p class="uk-text-meta uk-margin-remove-top">
                                    <span>You gained +%s new users in the last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body uk-text-white">
                        <p>%s Users still pending</p>
                        <ul class="uk-list uk-list-collapse uk-list-divider">
                        %s
                        </ul>
                    </div>
                    ',
                    IconLibrary::getIcon('user', 3.5),
                    $total, /* all tickets */
                    27, /* gained users */
                    self::totalPendingUsers($clientRepo->getClientCrud()) ?? 0,
                    self::resolver($clientRepo)
                );
            },
            'secondary'
            );
        }        
    }

    private static function resolver(object $clientRepo)
    {
        list($active, $pending, $lock, $trash) = self::userPercentage($clientRepo);
        return sprintf(
            '
            <li>%s Active</li>
            <li>%s Pending <small class="uk-text-danger">(critical)</small></li>
            <li>%s Locked</li>
            <li>%s Trashed</li>    
            ',
            ceil((float)$active) . '%',
            ceil((float)$pending) . '%',
            ceil((float)$lock) . '%',
            ceil((float)$trash) . '%'
        );
    }

}
