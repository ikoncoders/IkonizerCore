<?php
declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class isArray extends ValidationRuleMethods
{

    public function isArray(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (!is_array($validationClass->value)) {
                $this->getError(array_values(Error::display('err_invalid_array'))[0], $controller, $validationClass);
            }
        }
    }
}
