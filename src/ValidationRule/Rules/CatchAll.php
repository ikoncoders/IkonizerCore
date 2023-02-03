<?php

declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;


class CatchAll extends ValidationRuleMethods
{

    public function catchAll(object $controller, object $validationClass)
    {
        //if (!isset($validationClass->key)) {
            //if (!isset($validationClass->value)) {
                $this->getError(array_values(Error::display('catch_error'))[0], $controller, $validationClass);
            //}
        //}
    }
}
