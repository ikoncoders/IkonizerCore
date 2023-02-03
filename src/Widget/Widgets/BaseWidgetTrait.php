<?php
declare(strict_types=1);

namespace IkonizerCore\Widget\Widgets;

trait BaseWidgetTrait
{

    public static function resolvedLists(array $array = [], ?string $item = null): string
    {
        foreach ($array as $key => $value) {
            return sprintf(
                '
                <li>
                    <div class="uk-grid-small" uk-grid>
                        <div class="uk-width-expand" uk-leader>%s</div>
                        <div>%s%</div>
                    </div>
                </li>
                ',
                $key,
                $value[$item]
            );
        }

    }

}