<?php


declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class Required extends ValidationRuleMethods
{

    /**
     * Returns an error if one or more field is empty.
     *
     * @param object $controller
     * @param object $validationClass
     * @return void
     */
    public function required(object $controller, object $validationClass): void
    {
        if (isset($validationClass->key)) {
            if ($validationClass->value === '') {
                $this->getError(array_values(Error::display('err_field_require'))[0], $controller, $validationClass);
            }
        }
    }
}
