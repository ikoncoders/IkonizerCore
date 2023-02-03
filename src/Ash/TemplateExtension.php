<?php


declare(strict_types=1);

namespace IkonizerCore\Ash;

use IkonizerCore\Auth\Roles\PrivilegedUser;
use IkonizerCore\DataObjectLayer\DataLayerTrait;
use IkonizerCore\Utility\Yaml;
use IkonizerCore\Utility\DateFormatter;
use IkonizerCore\Base\BaseApplication;
use IkonizerCore\Ash\Traits\TemplateTraits;
use IkonizerCore\Ash\Components\Uikit\UikitNavigationExtension;
use IkonizerCore\Ash\Components\Uikit\UikitPaginationExtension;
use IkonizerCore\Ash\Components\Uikit\UikitSimplePaginationExtension;
use IkonizerCore\Ash\Components\Bootstrap\BsNavigationExtension;
use IkonizerCore\Ash\Components\Uikit\UikitCommanderBarExtension;
use IkonizerCore\Ash\Exception\TemplateLocaleOutOfBoundException;
use IkonizerCore\Ash\Components\Uikit\UikitFlashMessagesExtension;
use IkonizerCore\UserManager\Rbac\Permission\PermissionModel;
use IkonizerCore\UserManager\Rbac\Role\RoleModel;
use IkonizerCore\UserManager\UserModel;
use IkonizerCore\Setting\SettingModel;
use RuntimeException;

if (!class_exists(PermisisonModel::class) && !class_exists(UserModel::class)) {
    throw new RuntimeException('You are application is missing Permisson and User Models.');
}

class TemplateExtension
{

    /** @var TemplateTraits - holds common function used across template extensions */
    use TemplateTraits;
    use DataLayerTrait;
    use TemplateFunctionsTrait;

    /** @var array */
    protected mixed $js = null;
    /** @var array */
    protected mixed $css = null;
    /** @var string */
    protected string $string;

    private array $ext = [];
    private array $extensions;
    private object $controller;

    /**
     * Return an array of all the template extension class with the const extension
     * name as the key which represent the extension logic
     *
     * @return void
     */
    public function __construct(object $controller)
    {
        $this->controller = $controller;
        $this->extensions = [

            UikitNavigationExtension::NAME => UikitNavigationExtension::class,
            UikitPaginationExtension::NAME => UikitPaginationExtension::class,
            UikitSimplePaginationExtension::NAME => UikitSimplePaginationExtension::class,
            UikitCommanderBarExtension::NAME => UikitCommanderBarExtension::class,
            UikitFlashMessagesExtension::NAME => UikitFlashMessagesExtension::class,
            //BsNavigationExtension::NAME => BsNavigationExtension::class

        ];
    }


    /**
     * Return a registered extension
     *
     * @param string|null $extensionName
     * @param string|null $header
     * @param string|null $headerIcon
     * @return void
     */
    public function templateExtension(string|null $extensionName, ?string $header = null, ?string $headerIcon = null): mixed
    {
        if (count($this->extensions) > 0) {
            if (in_array($extensionName, array_keys($this->extensions))) {
                foreach ($this->extensions as $name => $extension) {
                    if ($extensionName === $name) {
                        $ext = BaseApplication::diGet($extension);
                        if ($ext) {
                            return call_user_func_array([$ext, 'register'], [$this->controller, $header, $headerIcon]);
                        }
                    }
                }
            }
        }
    }


}