<?php 
declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\Drivers;

use IkonizerCore\DataObjectLayer\Exception\DataLayerUnexpectedValueException;

class DatabaseDriverFactory
{

    /**
     * Create and return the database driver object. Passing the object environment and 
     * default database driver to the database driver constructor method.
     *
     * @param object $environment
     * @param string|null $dbDriverConnection
     * @param string $pdoDriver
     * @return DatabaseDriverInterface
     * @throws DataLayerUnexpectedValueException
     */
    public function create(object $environment, ?string $dbDriverConnection, string $pdoDriver): DatabaseDriverInterface
    {
        if (is_object($environment)) {
            $dbConnection = ($dbDriverConnection !==null) ? new $dbDriverConnection($environment, $pdoDriver) : new MysqlDatabaseConnection($environment, $pdoDriver);
            if (!$dbConnection instanceof DatabaseDriverInterface) {
                throw new DataLayerUnexpectedValueException();   
            }

            return $dbConnection;
        }
    }


}