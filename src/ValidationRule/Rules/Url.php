<?php

declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class Url extends ValidationRuleMethods
{

    public function url(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            if (filter_var($validationClass->value, FILTER_VALIDATE_URL) === false) {
                $this->getError(array_values(Error::display('err_invalid_url'))[0], $controller, $validationClass);
            }
        }
    }
}
