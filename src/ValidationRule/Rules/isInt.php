<?php

declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class isInt extends ValidationRuleMethods
{

    public function isInt(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_int($validationClass->value)) {
                $this->getError(array_values(Error::display('err_invalid_string'))[0], $controller, $validationClass);
            }
        }
    }
}
