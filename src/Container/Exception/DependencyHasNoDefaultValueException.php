<?php
declare(strict_types=1);

namespace IkonizerCore\Container\Exception;

use IkonizerCore\Container\NotFoundExceptionInterface;

class DependencyHasNoDefaultValueException extends ContainerException implements NotFoundExceptionInterface
{
}
