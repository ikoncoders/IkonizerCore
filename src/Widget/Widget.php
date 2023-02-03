<?php


declare(strict_types=1);

namespace IkonizerCore\Widget;

use IkonizerCore\Widget\Widgets\BaseWidget;
use IkonizerCore\Widget\Exception\WidgetException;
use IkonizerCore\Widget\Widgets\Notifications\NotificationWidget;
use IkonizerCore\Widget\Widgets\Tickets\TicketWidget;
use IkonizerCore\Widget\Widgets\Cards\ActiveNowWidget;
use IkonizerCore\Widget\Widgets\Cards\ContentWidget;
use IkonizerCore\Widget\Widgets\Cards\UsersWidget;
use IkonizerCore\Widget\Widgets\Cards\BounceRateWidget;
use IkonizerCore\Widget\Widgets\Cards\TotalVisitWidget;
use IkonizerCore\Widget\Widgets\ListsWidget\ListsWidget;
use IkonizerCore\Widget\Widgets\BackupStatus\BackupStatusWidget;
use IkonizerCore\Widget\Widgets\SystemLogger\SystemLoggerWidget;
use IkonizerCore\Widget\Widgets\WebsiteTraffic\WebsiteTrafficWidget;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepositoryInterface;
use IkonizerCore\Widget\Widgets\Cards\MoneyCardWidget;
use IkonizerCore\Widget\Widgets\Members\MemberWidget;
use IkonizerCore\Widget\Widgets\ProgressBar\ProgressBarWidget;

/**
 * All widgets must be registered within this Widget class before it becomes available for use
 * within the template
 */
class Widget extends AbstractWidget
{

    /* @var array widgets */
    private const ALLOWED_WIDGETS = [
        ActiveNowWidget::WIDGET_NAME => ['class' => ActiveNowWidget::class],
        BounceRateWidget::WIDGET_NAME => ['class' => BounceRateWidget::class],
        TotalVisitWidget::WIDGET_NAME => ['class' => TotalVisitWidget::class],
        ContentWidget::WIDGET_NAME => ['class' => ContentWidget::class],
        UsersWidget::WIDGET_NAME => ['class' => UsersWidget::class],
        BackupStatusWidget::WIDGET_NAME => ['class' => BackupStatusWidget::class],
        SystemLoggerWidget::WIDGET_NAME => ['class' => SystemLoggerWidget::class],
        WebsiteTrafficWidget::WIDGET_NAME => ['class' => WebsiteTrafficWidget::class],
        ListsWidget::WIDGET_NAME => ['class' => ListsWidget::class],
        TicketWidget::WIDGET_NAME => ['class' => TicketWidget::class],
        MemberWidget::WIDGET_NAME => ['class' => MemberWidget::class],
        NotificationWidget::WIDGET_NAME => ['class' => NotificationWidget::class],
        ProgressBarWidget::WIDGET_NAME => ['class' => ProgressBarWidget::class],
        MoneyCardWidget::WIDGET_NAME => ['class' => MoneyCardWidget::class],
    ];

    /* @var $clientRepo */
    protected ClientRepositoryInterface $clientRepo;
    /* @var array */
    protected array $widgetPackage = [];
    /* @var string */
    private ?string $widgetName = null;

    /**
     * Main Widget class constructor
     *
     * @param ?ClientRepositoryInterface $clientRepo
     * @param array $widgetPackage
     */
    public function __construct(?ClientRepositoryInterface $clientRepo = null, array $widgetPackage = [])
    {
        $this->clientRepo = $clientRepo;
        $this->baseWidget = new BaseWidget();
        /* the widget package contain the database parameters the widget may wants access to */
        list($this->widgetName, $this->widgetSchema, $this->widgetSchemaID) = $widgetPackage;
    }

    /**
     * @inheritDoc
     */
    public function renderWidget(mixed $widgetData = null): mixed
    {
        if (!in_array($this->widgetName, array_keys(self::ALLOWED_WIDGETS))) {
            throw new WidgetException(sprintf('Invalid widget %s. Does not exists within the widget library', $this->widgetName));
        }
        if (is_array(self::ALLOWED_WIDGETS) && count(self::ALLOWED_WIDGETS) > 0) {
            foreach (self::ALLOWED_WIDGETS as $widgetName => $widgetClass) {
                if (str_contains($widgetName, $this->widgetName)) {
                    switch ($widgetName) {
                        case $widgetName :
                            return $widgetClass['class']::render(
                                $this->widgetName,
                                $this->clientRepo,
                                $this->baseWidget,
                                $widgetData
                            );
                            break;
                    }
    
                }
            }
        }

        return false;
    }
}
