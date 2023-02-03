<?php


declare(strict_types=1);

namespace IkonizerCore\ValidationRule\Rules;

use IkonizerCore\Error\Error;
use IkonizerCore\ValidationRule\ValidationRuleMethods;

class Unique extends ValidationRuleMethods
{

    public function unique(object $controller, object $validationClass)
    {
        if (isset($validationClass->key)) {
            $result = $controller->repository
                ->getRepo()
                ->findObjectBy([$validationClass->key => $validationClass->value], ['*']);
            if ($result) {
                $ignoreID = (!empty($controller->thisRouteID()) ? $controller->thisRouteID() : null);
                if ($result->id == $ignoreID) {
                    $this->getError(array_values(Error::display('err_data_exists'))[0], $controller, $validationClass);
                }
            }
        }
    }
}
