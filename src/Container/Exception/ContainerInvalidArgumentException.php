<?php
declare(strict_types=1);

namespace IkonizerCore\Container\Exception;

use IkonizerCore\Container\ContainerExceptionInterface;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;

/** PSR-11 Container */
class ContainerInvalidArgumentException extends BaseInvalidArgumentException implements ContainerExceptionInterface
{
}
