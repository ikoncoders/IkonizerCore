<?php
declare(strict_types=1);

namespace IkonizerCore\Container\Exception;

use IkonizerCore\Container\NotFoundExceptionInterface;

/** PSR-11 Container */
class DependencyIsNotInstantiableException extends ContainerException implements NotFoundExceptionInterface
{
}
