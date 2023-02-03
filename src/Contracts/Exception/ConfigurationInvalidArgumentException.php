<?php
declare(strict_types=1);

namespace IkonizerCore\Contracts\Exception;

class ConfigurationInvalidArgumentException extends \InvalidArgumentException
{

    public $message = 'Your component configurations class does not implement the ConfigurationInterface. This is a requirement';

}