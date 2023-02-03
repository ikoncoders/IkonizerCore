<?php

declare(strict_types=1);

namespace IkonizerCore\Router\Exception;

use BadFunctionCallException;

class RouterNoControllerFoundException extends BadFunctionCallException
{}