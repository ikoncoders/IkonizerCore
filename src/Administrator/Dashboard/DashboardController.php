<?php

declare(strict_types=1);

namespace IkonizerCore\Administrator\Dashboard;

use IkonizerCore\Base\Access;
use IkonizerCore\Base\Domain\Actions\DashboardAction;
use IkonizerCore\Administrator\Dashboard\DashboardSchema;
use IkonizerCore\Administrator\Dashboard\DashboardRepository;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;
use IkonizerCore\Administrator\Dashboard\DashboardSettingsForm;
use IkonizerCore\Asministrator\Dashboard\Event\DashboardActionEvent;

class DashboardController extends \IkonizerCore\Administrator\Controller\AdminController
{

    /**
     * Extends the base constructor method. Which gives us access to all the base
     * methods implemented within the base controller class.
     * Class dependency can be loaded within the constructor by calling the
     * container method and passing in an associative array of dependency to use within
     * the class
     *
     * @param array $routeParams
     * @return void
     * @throws BaseInvalidArgumentException
     */
    public function __construct(array $routeParams)
    {
        parent::__construct($routeParams);
        /**
         * Dependencies are defined within a associative array like example below
         * [ userModel => \App\Model\UserModel::class ]. Where the key becomes the
         * property for the userModel object like so $this->userModel->getRepo();
         */
        $this->addDefinitions(
            [
                'repository' => DashboardModel::class,
                'repo' => DashboardRepository::class, 
                'schema' => DashboardSchema::class,
                'dashboardAction' => DashboardAction::class,
                'dashboardSettingsForm' => DashboardSettingsForm::class
            ]
        );
    }

    public function schemaAsString(): string
    {
        return DashboardSchema::class;
    }

    /**
     * Entry method which is hit on request. This method should be implement within
     * all sub controller class as a default landing point when a request is
     * made.
     */
    protected function indexAction()
    {
        $this->render(
            'admin/dashboard/index.html',
            [
                'nav_switcher' => $this->repo->getNavSwitcher(),
                'main_cards' => $this->repo->mainCards(),
                'todays_datetime' => date("F j, Y, g:i a"),
                'progress_bar_data' => $this->repo->getProgressBarData(),
                'money_card_data' => $this->repo->getMoneyCardData(),
            ]
        );
    }

    protected function datetimeAction()
    {
        $msg = date("F j, Y, g:i a");
        echo $msg;
    }

    protected function settingsAction()
    {
        $this->dashboardAction
            ->setAccess($this, Access::CAN_MANANGE_SETTINGS)
            ->execute($this, NULL, DashboardActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with(
                [
                    'page_title' => 'Dashboard Settings'
                ]
            )
            ->form($this->dashboardSettingsForm)
            ->end();
    }

    protected function healthAction()
    {
        $this->dashboardAction
            ->setAccess($this, Access::CAN_MANANGE_SETTINGS)
            ->execute($this, NULL, DashboardActionEvent::class, NULL, __METHOD__)
            ->render()
            ->with(
                [
                    'page_title' => 'System Health'
                ]
            )
            ->info()
            ->end();
    }

    protected function historyAction()
    {

    }


}