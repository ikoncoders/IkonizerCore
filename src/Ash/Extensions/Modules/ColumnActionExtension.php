<?php

declare(strict_types=1);

namespace IkonizerCore\Ash\Extensions\Modules;

use IkonizerCore\Ash\Extensions\Modules\IconNavExtension;

class ColumnActionExtension
{

    /**
     *
     * @param array $action
     * @param array $row
     * @param Object $twigExt
     * @param string $controller
     * @param boolean $vertical
     * @param string $title
     * @param string $description
     * @return string
     */
    public function action(
        array $action, 
        array $row = null, 
        Object $twigExt = null, 
        string $controller, 
        bool $vertical = false,
        string $title = null,
        string $description = null, ?string $permission = null): string
    {
        $iconNav = new IconNavExtension();
        $element = '';
        if (is_array($action) && count($action) > 0) {
            if ($row !=null) {
                $element .= $iconNav->iconNav($action, $row, $twigExt, $controller, $vertical, null, $permission);
            }
            $element .= $iconNav->confirmationModal($row['id'], $controller, $title, $description);
        }
        return $element;
    }
}
