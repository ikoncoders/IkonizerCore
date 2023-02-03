<?php

declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class isNumeric extends ValidationRuleMethods
{

    public function isNumeric(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_numeric($validationClass->value)) {
                $this->getError(array_values(Error::display('err_invalid_numeric'))[0], $controller, $validationClass);
            }
        }
    }
}
