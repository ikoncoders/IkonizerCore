<?php
declare(strict_types=1);

namespace IkonizerCore\Ash\Uikit\Components;

use IkonizerCore\Ash\Uikit\AbstractUikitComponent;

class Card extends AbstractUikitComponent
{

    public array $props = [
        'type' => 'default',
        'use_header' => false,
        'use_footer' => false,
        'grid' => '',
        'width' => '',
    ];

    /**
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->props = array_merge($this->props, $properties);
    }

    public function render()
    {
        return sprintf(
            '<div class="uk-card uk-card-%s">%s</div>',
            $this->props['type'],
            $this->callback
        );
    }

}

