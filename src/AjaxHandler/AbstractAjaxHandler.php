<?php
declare(strict_types=1);

namespace IkonizerCore\AjaxHandler;

use Exception;

/**
 * Soft Exception will send error but use 200 as a status code instead of 400
 * Useful for JSONP requests
 */
abstract class AbstractAjaxHandler implements AjaxHandlerInterface
{}
