<?php

declare(strict_types=1);

namespace IkonizerCore\DataObjectLayer\DataRepository;

use Exception;
use IkonizerCore\Utility\Stringify;
use IkonizerCore\Base\BaseApplication;

trait DataRelationshipTrait
{

    /**
     * @throws Exception
     */
    public function findManyToMany(string $tablePivot)
    {
        if ($tablePivot) {
            $newPivotObject = BaseApplication::diGet($tablePivot);
            if (!$newPivotObject) {
                throw new Exception();
            }
            /* explode the pivot table string and extract both associative tables */
            $tableNames = explode('_', $newPivotObject->getSchema());
            if (is_array($tableNames) && count($tableNames) > 0) {
                $test = array_filter($tableNames, function($tableName) {
                    $suffix = 'Model';
                    $namespace = '\App\Model\\';
        
                    if (is_string($tableName)) {
                        $modelNameSuffix = $tableName . $suffix;
                        $modelName = Stringify::studlyCaps($modelNameSuffix);
                        if (class_exists($newModelClass = $namespace . $modelName)) {
                            $newModelObject = BaseApplication::diGet($newModelClass);
                            if (!$newModelObject) {
                                throw new Exception();
                            }

                        }
                        return $newModelObject;

                    }
                });
                var_dump($test);
                die;
            }
        }
    }

}