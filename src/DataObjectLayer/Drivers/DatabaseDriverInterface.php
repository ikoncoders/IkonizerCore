<?php 
declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Drivers;

use PDO;

interface DatabaseDriverInterface
{

    public function open(): PDO;
    public function close();
    
}