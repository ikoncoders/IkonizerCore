<?php
declare(strict_types=1);

namespace IkonizerCore\AjaxHandler;

use IkonizerCore\Base\Exception\BaseException;

/**
 * Soft Exception will send error but use 200 as a status code instead of 400
 * Useful for JSONP requests
 */
class AjaxHandlerException extends BaseException 
{}
