<?php
declare(strict_types=1);

namespace IkonizerCore\Administrator\Controller;

use IkonizerCore\Base\Exception\BaseInvalidArgumentException;
use IkonizerCore\Administrator\AccessDeniedCommander;

class AccessDeniedController extends \IkonizerCore\Administrator\Controller\AdminController
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
        $this->addDefinitions(
            [
                'commander' => AccessDeniedCommander::class,
            ]
        );

    }

    protected function indexAction()
    {
        $this->render('admin/accessDenied/index.html');
    }


}

