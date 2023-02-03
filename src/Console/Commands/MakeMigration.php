<?php
declare(strict_types=1);

namespace IkonizerCore\Console\Commands;

use IkonizerCore\Console\ConsoleCommand;
use IkonizerCore\Base\Exception\BaseLogicException;
use IkonizerCore\Base\Exception\BaseRuntimeException;
use IkonizerCore\Console\Commands\Traits\MakeMigrationTrait;
use IkonizerCore\Base\Exception\BaseInvalidArgumentException;
use IkonizerCore\Console\Exception\MakeCommandFileAlreadyExistException;

class MakeMigration extends ConsoleCommand
{

    use MakeMigrationTrait;

    protected string $schemaNamespace = '\App\Database\Schema';
    protected array $schemaFiles = [];

    /* @var string comomand name */
    protected string $name = 'magma:make:migration';
    /* @var string command description */
    protected string $description = 'Make migration commands for database schema files';
    /* @var string command help */
    protected string $help = 'Command which can generate a class file from a set of predefined stub files';

    /**
     * Return all schema files from the schema directory if they exists
     * @param array $migrationFiles
     */
    public function getSchemaFiles()
    {
        $files = realpath(ROOT_PATH . $this->schemaNamespace);
        if (is_bool($files) && $files !==true) {
            throw new BaseLogicException('Your migration directory is currently empty.');
        }

        return glob($files . '/*.php');
    }

    /* @var array command options */
    protected array $options = [
        [
            'migrate',
            '-m',
            'required',
            'Create migration scripts from the application schema classes. Schema classes must exist for migrations to be to created.',
            false
        ],
    ];

    /**
     * Dispatch the command
     * @return int
     */
    public function dispatch(): int
    {
        $option = $this->getOptions('migrate');

        try {
            $this->resolveMigrationFromOptions($option);
            $this->terminalQuestion('Your file was created successfully');
            return ConsoleCommand::SUCCESS;
        } catch(MakeCommandFileAlreadyExistException|BaseInvalidArgumentException|BaseRuntimeException $e) {
            $this->terminalError(sprintf('%s', $e->getMessage()));
        } finally {
            return ConsoleCommand::FAILURE;
        }

    }


}