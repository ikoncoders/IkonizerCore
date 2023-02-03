<?php
declare(strict_types=1);

namespace IkonizerCore\Container\Exception;

use IkonizerCore\Base\Exception\BaseException;
use IkonizerCore\Container\ContainerExceptionInterface;

/** PSR-11 Container */
class ContainerException extends BaseException implements ContainerExceptionInterface
{
}
