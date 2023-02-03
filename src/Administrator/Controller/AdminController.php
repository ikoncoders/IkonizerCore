<?php
declare (strict_types=1);

namespace IkonizerCore\Administrator\Controller;

use IkonizerCore\Base\Access;
use IkonizerCore\Utility\Serializer;
use IkonizerCore\Base\BaseController;
use IkonizerCore\Datatable\Datatable;
use IkonizerCore\RestFul\RestHandler;
use IkonizerCore\Session\SessionTrait;
use IkonizerCore\Base\Domain\Actions\NewAction;
use IkonizerCore\Administrator\Forms\ExportForm;
use IkonizerCore\Administrator\Forms\ImportForm;
use IkonizerCore\Base\Domain\Actions\EditAction;
use IkonizerCore\Base\Domain\Actions\ShowAction;
use IkonizerCore\Base\Traits\TableSettingsTrait;
use IkonizerCore\System\Event\SystemActionEvent;
use IkonizerCore\Base\Domain\Actions\BlankAction;
use IkonizerCore\Base\Domain\Actions\CloneAction;
use IkonizerCore\Base\Domain\Actions\IndexAction;
use IkonizerCore\Base\Domain\Actions\DeleteAction;
use IkonizerCore\Base\Domain\Actions\ExportAction;
use IkonizerCore\Base\Domain\Actions\ImportAction;
use IkonizerCore\Base\Traits\SessionSettingsTrait;
use IkonizerCore\Base\Domain\Actions\UpdateOnEvent;
use IkonizerCore\Base\Traits\ControllerCommonTrait;
use IkonizerCore\Base\Domain\Actions\LogIndexAction;
use IkonizerCore\Base\Domain\Actions\SettingsAction;
use IkonizerCore\Base\Domain\Actions\ShowBulkAction;
use IkonizerCore\Base\Traits\ControllerSessionTrait;
use IkonizerCore\Base\Domain\Actions\BulkCloneAction;
use IkonizerCore\Administrator\ControllerSettingsForm;
use IkonizerCore\Base\Domain\Actions\BulkDeleteAction;
use IkonizerCore\Base\Domain\Actions\BulkUpdateAction;
use IkonizerCore\Base\Domain\Actions\ChangeRowsAction;
use IkonizerCore\Base\Domain\Actions\IfCanTrashAction;
use IkonizerCore\Administrator\ControllerSettingsModel;
use IkonizerCore\Base\Domain\Actions\ChangeStatusAction;
use IkonizerCore\Base\Domain\Actions\SimpleCreateAction;
use IkonizerCore\Base\Domain\Actions\SimpleUpdateAction;
use IkonizerCore\UserManager\Forms\Admin\BulkDeleteForm;
use IkonizerCore\Base\Domain\Actions\SessionUpdateAction;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;
use IkonizerCore\Administrator\Middleware\Before\LoginRequired;
use IkonizerCore\Administrator\Middleware\Before\SessionExpires;
use IkonizerCore\Administrator\Middleware\Before\AuthorizedIsNull;
use IkonizerCore\Administrator\Model\ControllerSessionBackupModel;
use IkonizerCore\Administrator\Middleware\Before\AdminAuthentication;

/**
 * Basic controller protected route methods
 * 
 * indexAction()
 * showAction() (optional)
 * newAction()
 * editAction()
 * deleteAction()
 * trashAction()
 * untrashAction()
 * activeAction
 * inactiveAction()
 * 
 * INHERITED ROUTES
 * ===============================
 * 
 * bulkAction()
 * settingsAction()
 * importAction()
 * exportAction()
 * helpAction()
 * logAction() (optional)
 * 
 */
class AdminController extends BaseController
{

    use SessionTrait;
    use TableSettingsTrait;
    use SessionSettingsTrait;
    use ControllerSessionTrait;
    use ControllerCommonTrait;

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
        $this->diContainer(
            [
                'tableGrid' => Datatable::class,
                'blankAction' => BlankAction::class,
                'simpleUpdateAction' => SimpleUpdateAction::class,
                'simpleCreateAction' => SimpleCreateAction::class,
                'newAction' => NewAction::class,
                'editAction' => EditAction::class,
                'deleteAction' => DeleteAction::class,
                'bulkDeleteAction' => BulkDeleteAction::class,
                'bulkCloneAction' => BulkCloneAction::class,
                'bulkUpdateAction' => BulkUpdateAction::class,
                'showBulkAction' => ShowBulkAction::class,
                'indexAction' => IndexAction::class,
                'cloneAction' => CloneAction::class,
                'logIndexAction' => LogIndexAction::class,
                'showAction' => ShowAction::class,
                'updateOnEvent' => UpdateOnEvent::class,
                'changeStatusAction' => ChangeStatusAction::class,
                'settingsAction' => SettingsAction::class,
                'apiResponse' => RestHandler::class,
                'changeRowsAction' => ChangeRowsAction::class,
                'controllerSettingsForm' => ControllerSettingsForm::class,
                'controllerRepository' => ControllerSettingsModel::class,
                'bulkDeleteForm' => BulkDeleteForm::class,
                'ifCanTrashAction' => IfCanTrashAction::class,
                'sessionUpdateAction' => SessionUpdateAction::class,
                'controllerSessionBackupModel' => ControllerSessionBackupModel::class,
                'exportForm' => ExportForm::class,
                'importForm' => ImportForm::class,
                'exportAction' => ExportAction::class,
                'importAction' => ImportAction::class,
            ]
        );

    }

    /**
     * Middleware which are executed before any action methods is called
     * middlewares are return within an array as either key/value pair. Note
     * array keys should represent the name of the actual class its loading ie
     * upper camel case for array keys. alternatively array can be defined as
     * an index array omitting the key entirely
     *
     * @return array
     */
    protected function callBeforeMiddlewares(): array
    {
        return [
            'LoginRequired' => LoginRequired::class,
            'AdminAuthentication' => AdminAuthentication::class,
            'AuthorizedIsNull' => AuthorizedIsNull::class,
            'SessionExpires' => SessionExpires::class,
        ];
    }

    /**
     * After filter which is called after every controller. Can be used
     * for garbage collection
     *
     * @return array
     */
    protected function callAfterMiddlewares(): array
    {
        return [];
    }

    /**
     * Returns the method path as a string to use with the redirect method.
     * The method will generate the necessary redirect string based on the
     * current route.
     *
     * @param string $action
     * @param Object $controller
     * @return string
     */
    public function getRoute(string $action, object $controller): string
    {
        $self = '';
        if (!empty($this->thisRouteID()) && $this->thisRouteID() !== false) {
            if ($this->thisRouteID() === $this->findOr404()) {
                $route = "/{$this->thisRouteNamespace()}/{$this->thisRouteController()}/{$this->thisRouteID()}/{$this->thisRouteAction()}";
            }
        } else {
            $self = "/{$this->thisRouteNamespace()}/{$this->thisRouteController()}/{$action}";
        }

       // if ($self) {
            return $self;
        //}
    }

    /**
     * Checks whether the entity settings is being called from the correct
     * controller and return true. returns false otherwise
     *
     * @param string $autoController
     * @return boolean
     */
    private function isControllerValid(string $autoController): bool
    {
        if (is_array($this->routeParams) && in_array($autoController, $this->routeParams, true)) {
            if (isset($this->routeParams['controller']) && $this->routeParams['controller'] == $autoController) {
                return true;
            }
        }
        return false;
    }

    /**
     * Global 
     *
     * @return void
     */
    protected function changeRowAction()
    {
        $key = $this->thisRouteController() . '_settings';
        $newRecordsPerPage = (string)$this->request->handler()->query->getAlnum('rpp');
        $session = $this->getSessionData($key, $this);
        if ($session['records_per_page'] !== $newRecordsPerPage) {
            unset($session['records_per_page']);
            $updatedSession = ['records_per_page' => $newRecordsPerPage];
            $this->getSession()->delete('user_settings');
            $newArray = $session + $updatedSession;

            $this->getSession()->set($key, $newArray);
            
        }
        $this->flashMessage('updated!');
        $this->redirect($_SERVER['HTTP_REFERER']);

    }

    public function sessionModel(object $controller = null): ?object
    {
        return $this->controllerSessionBackupModel
        ->getRepo()
        ->findObjectBy(['controller' => $controller->thisRouteController() . '_settings']);

    }

    public function sessionModelContext(object $controller = null): array|bool
    {
        $context = $this->sessionModel($controller)->context;
        if ($context) {
            return Serializer::unCompress($context);
        }
        return false;
    }

    /**
     * Return the unserialized session data
     *
     * @param object|null $controller
     * @return mixed
     */
    public function controllerSessionData(object $controller = null): mixed
    {
        $serialized = $controller->getSession()->get($this->thisRouteController() . '_settings');
        if ($serialized) {
            return Serializer::unCompress($serialized);
        }

        return false;
    }


    protected function discoveryRefreshAction()
    {
      $this->pingMethods($this->thisRouteController(), sprintf('\App\Controller\Admin\%sController', ucwords($this->thisRouteController())));
      $this->redirect('/admin/discovery/discover');

    }

    /**
     * Controller import route. All routes which inherits this admin controller we automatically
     * be able to import content to the database. Uses the SystemActionEvent globally.
     * All controller must also define the $this->rawSchema property within the addDefinition array
     *
     * @return void
     */                    
    protected function importAction()
    {
        $this->importAction
        ->execute($this, null, SystemActionEvent::class, $this->rawSchema, __METHOD__)
        ->render('admin/_global/_global_import.html')
        ->with(
            [
            ]
        )
        ->form($this->importForm)
        ->end();

    }

    /**
     * Controller export route. All routes which inherits this admin controller we automatically
     * be able to export its content from the database. Uses the SystemActionEvent globally.
     * All controller must also define the $this->rawSchema property within the addDefinition array
     *
     * @return void
     */
    protected function exportAction()
    {
        $this->exportAction
            ->execute($this, null, SystemActionEvent::class, $this->rawSchema, __METHOD__)
            ->render('admin/_global/_global_export.html')
            ->with(
                [
                    'export' => $this->getSessionSettings($this, 'session_export_settings')
                ]
            )
            ->form($this->exportForm)
            ->end();
    }

    private function throwNoEventException(): void
    {
        if (!isset($this->actionEvent)) {
            throw new \Exception(
                sprintf('%s string is not defined within your controller %s', 
                $this->actionEvent, 
                $this->thisRouteController())
            );
        }

    }

    private function throwNoSchemaException(): void
    {
        if (!isset($this->rawSchema)) {
            throw new \Exception(
                sprintf('%s string is not defined within your controller %s', 
                $this->rawSchema, 
                $this->thisRouteController())
            );
        }

    }

    /**
     * Return the qualified namespace for the schema class. throw a exception if the class
     * does not define the nameapace property.
     *
     * @return void
     */
    public function schemaAsString()
    {
        $this->throwNoSchemaException();
        return $this->rawSchema;
    }


    /**
     * Bulk action route which will be available to any controller which inherits this 
     * main admin controller
     *
     * @return void
     */
    public function bulkAction()
    {
        $this->throwNoEventException();
        $this->chooseBulkAction($this, $this->actionEvent);
    }


    /**
     * settings page which all registered controller will inherit
     *
     * @return Response
     */
    protected function settingsAction()
    {
        $this->throwNoEventException();
        $sessionData = $this->getSession()->get($this->thisRouteController() . '_settings');
        $this->sessionUpdateAction
            ->setAccess($this, Access::CAN_MANANGE_SETTINGS)
            ->execute($this, NULL, $this->actionEvent, NULL, __METHOD__, [], [], ControllerSessionBackupModel::class)
            ->render()
            ->with(
                [
                    'session_data' => $sessionData,
                    'page_title' => ucwords($this->thisRouteController()) . ' Settings',
                    'last_updated' => $this->controllerSessionBackupModel
                        ->getRepo()
                        ->findObjectBy(['controller' => $this->thisRouteController() . '_settings'], ['created_at'])->created_at
                ]
            )
            ->form($this->controllerSettingsForm, null, $this->toObject($sessionData))
            ->end();
    }


}
