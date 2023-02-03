<?php
declare(strict_types=1);

namespace IkonizerCore\Fillable;

use IkonizerCore\Fillable\Faker\Faker;

class FillableBlueprint implements FillableBlueprintInterface
{

    private Faker $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;  
    }

    public function faker(): object
    {
        return $this->faker;
    }
}