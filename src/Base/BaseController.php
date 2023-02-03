<?php
declare(strict_types=1);

namespace IkonizerCore\Base;

use IkonizerCore\Base\BaseApplication;
// use IkonizerCore\Base\Events\BeforeRenderActionEvent;
use IkonizerCore\Base\Events\BeforeControllerActionEvent;
use IkonizerCore\Base\Traits\ControllerFlashTrait;
use IkonizerCore\Base\Traits\ControllerMenuTrait;
use IkonizerCore\Base\Traits\ControllerMonitorTrait;
// use IkonizerCore\Base\Traits\ControllerPrivilegeTrait;
use IkonizerCore\Base\Traits\ControllerViewTrait;
// use IkonizerCore\Session\GlobalManager\GlobalManager;
use IkonizerCore\Utility\Yaml;
use IkonizerCore\Base\BaseView;
// use IkonizerCore\Auth\Authorized;
use IkonizerCore\Base\BaseRedirect;
// use IkonizerCore\Session\Flash\Flash;
use IkonizerCore\Session\SessionTrait;
// use IkonizerCore\Ash\TemplateExtension;
use IkonizerCore\Middleware\Middleware;
// use IkonizerCore\Session\Flash\FlashType;
// use IkonizerCore\Base\Exception\BaseLogicException;
use IkonizerCore\Base\Traits\ControllerCastingTrait;
// use IkonizerCore\Auth\Roles\PrivilegedUser;
// use IkonizerCore\UserManager\UserModel;
// use IkonizerCore\UserManager\Rbac\Permission\PermissionModel;
use IkonizerCore\Base\Exception\BaseBadMethodCallException;
use Exception;
use IkonizerCore\Base\Traits\TableSettingsTrait;

class BaseController extends AbstractBaseController
{

    use SessionTrait,
        ControllerCastingTrait,
        //ControllerPrivilegeTrait,
        ControllerMenuTrait,
        TableSettingsTrait,
        ControllerFlashTrait,
        ControllerViewTrait,
        ControllerMonitorTrait;

    /** @var array */
    protected array $routeParams;
    /** @var object */
    protected Object $templateEngine;
    /** @var */
    protected object $template;
    /** @var array */
    protected array $callBeforeMiddlewares = [];
    /** @var array */
    protected array $callAfterMiddlewares = [];
    protected array $controllerContext = [];
    protected array $addLinkModelToArray = [];
    protected array $noSettingsController = [
        'setting',
        'dashboard',
        'history',
        'discovery',
        'notification',
        'error'
    ];
    protected array $headers = ["User-Agent:", "Authorization:"];

    /**
     * Main class constructor
     *
     * @param array $routeParams
     */
    public function __construct(array $routeParams, array $menuItems = [])
    {
        parent::__construct($routeParams);
        $this->routeParams = $routeParams;
        $this->templateEngine = new BaseView();

        $this->diContainer(Yaml::file('providers'));
        $this->initEvents();
        $this->buildControllerMenu($routeParams);

        if (!in_array($routeParams['controller'], $this->noSettingsController)) {
            $this->initalizeControllerSession($this);
        }
        $this->pingMethods();

        $this->showDiscoveries();
        $this->recordHistory();
    }

    /**
     * Return and instance of the base application class
     * @return \IkonizerCore\Base\BaseApplication
     */
    public function baseApp()
    {
        return new BaseApplication();
    }

    public function getRouteParams(): array
    {
        return $this->routeParams;
    }

    /**
     * Magic method called when a non-existent or inaccessible method is
     * called on an object of this class. Used to execute before and after
     * filter methods on action methods. Action methods need to be named
     * with an "Action" suffix, e.g. indexAction, showAction etc.
     *
     * @param $name
     * @param $arguments
     * @throws BaseException
     * @return void
     */
    public function __call($name, $argument)
    {
        if (is_string($name) && $name !== '') {
            $method = $name . 'Action';
            if (method_exists($this, $method)) {
                if ($this->eventDispatcher->hasListeners(BeforeControllerActionEvent::NAME)) {
                    $this->dispatchEvent(
                        BeforeControllerActionEvent::class, 
                        $name, 
                        $this->routeParams, 
                        $this
                    );
                }        
                if ($this->before() !== false) {
                    call_user_func_array([$this, $method], $argument);
                    $this->after();
                }
            } else {
                http_response_code(404);
                $this->getSession()->set('invalid_method', $method);
                header('Location: http://localhost/error/errora');
                exit;        
            }
        } else {
            throw new Exception;
        }
    }

    protected function defineCoreMiddeware(): array
    {
        return [
            'error404' => Erorr404::class
        ];
    }

    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callBeforeMiddlewares(): array
    {
        return array_merge($this->defineCoreMiddeware(), $this->callBeforeMiddlewares);
    }

    /**
     * Returns an array of middlewares for the current object which will
     * execute before the action is called. Middlewares are also resolved
     * via the container object. So you can also type hint any dependency
     * you need within your middleware constructor. Note constructor arguments
     * cannot be resolved only other objects
     *
     * @return array
     */
    protected function callAfterMiddlewares(): array
    {
        return $this->callAfterMiddlewares;
    }

    /**
     * Before method. Call before controller action method
     * @return void
     */
    protected function before()
    {
        $object = new self($this->routeParams);
        (new Middleware())->middlewares($this->callBeforeMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }

    /**
     * After method. Call after controller action method
     * 
     * @return void
     */
    protected function after()
    {
        $object = new self($this->routeParams);
        (new Middleware())->middlewares($this->callAfterMiddlewares())
            ->middleware($object, function ($object) {
                return $object;
            });
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routeParams;
    }

    /**
     * @inheritdoc
     *
     * @param string $url
     * @param boolean $replace
     * @param integer $responseCode
     * @return void
     */
    public function redirect(string $url, bool $replace = true, int $responseCode = 303)
    {
        $this->redirect = new BaseRedirect(
            $url,
            $this->routeParams,
            $replace,
            $responseCode
        );

        if ($this->redirect) {
            $this->redirect->redirect();
        }
    }

    public function onSelf()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            return $_SERVER['REQUEST_URI'];
        }
    }

    public function getSiteUrl(?string $path = null): string
    {
        return sprintf(
            "%s://%s%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            ($path !== null) ? $path : $_SERVER['REQUEST_URI']
        );
    }

    /**
     * Returns a translation string to convert to default or choosen locale
     *
     * @param string $locale
     * @return string
     */
    public function locale(?string $locale = null): ?string
    {
        /*if (null !== $locale)
            return Translation::getInstance()->$locale;*/
        return $locale;
    }

    /**
     * Returns the session object for use throughout any controller. Can be used 
     * to called any of the methods defined with the session class
     *
     * @return object
     */
    public function getSession(): object
    {
        return SessionTrait::sessionFromGlobal();
    }

    public function getCache()
    {
        return $this->cache();
    }

    /**
     * Return the cache object
     */
    public function cache(): object
    {
        return $this->baseApp($this)->loadCache();
    }

//    public function themeBuilder(): object
//    {
//        $themeBuilder = GlobalManager::get('themeBuilder_global');
//        return $themeBuilder;
//    }

    public function recordHistory(): void
    {
        $session = $this->getSession();
        $session->setArray('sesson_history_trace', ['history_path' => $_SERVER['HTTP_REFERER'], 'history_user' => $session->get('user_id'), 'history_browser_agent' => $_SERVER['HTTP_USER_AGENT'], 'history_timestamp' => date('h:i:s')]);
    }

    public function dump(mixed $var, bool $die = true, array $optional = [])
    {
        var_dump($var, $optional);
        if ($die) {
            die();
        }
    }

    public function getHttpCode($url) {
        $handle = curl_init($url);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($handle);
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        curl_close($handle);
        return $httpCode;         
      }    
}
