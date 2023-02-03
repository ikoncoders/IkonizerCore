<?php

declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class Password extends ValidationRuleMethods
{

    public function password(object $controller, object $validationClass, int $length)
    {
        $error = [];
        if (!empty($validationClass->value)) {
            if (strlen($validationClass->value) < $length) {
                $error = Error::display('err_password_length');
            }
            if (preg_match('/.*\d+.*/i', $validationClass->value) == 0) {
                $error = Error::display('err_password_letter');
            }
            if (preg_match('/.*[a-z]+.*/i', $validationClass->value) == 0) {
                $error = Error::display('err_password_letter');
            }
            $this->getError(array_values($error[0]), $controller, $validationClass);
        }
    }
}
