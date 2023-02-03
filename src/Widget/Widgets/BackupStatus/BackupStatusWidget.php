<?php

declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets\BackupStatus;

use IkonizerCore\IconLibrary;
use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Widgets\WidgetBuilderInterface;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;
use IkonizerCore\Utility\Utilities;

class BackupStatusWidget extends Widget implements WidgetBuilderInterface
{   

    /* @var string the widget name */
    public const WIDGET_NAME = 'backup_status_widget';

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
        /* We are only double checking we are on the correct widget */
        if ($widgetName === self::WIDGET_NAME) {
            return $baseWidget::card(function($base) use ($clientRepo) {

                $updates = $clientRepo->get(['old_version' => '1.3']);
                $updates = Utilities::flattenContext($updates);

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
                                    <time datetime="%s">Last backup %s</time>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <p>%s</p>
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand" uk-leader>Version</div>
                            <div>%s</div>
                        </div>
    
                    </div>
                    ',
                    IconLibrary::getIcon('cloud-download', 3.5),
                    'Update & Backup',
                    '2016-04-01T19:00',
                    '2 days ago',
                    'Your\'re using the most upto date version of MagmaCore framework',
                    $updates['new_version'],
                );
            },
            ''
            );
        }        
    }

}
