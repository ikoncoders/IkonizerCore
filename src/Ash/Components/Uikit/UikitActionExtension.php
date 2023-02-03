<?php
declare(strict_types=1);

namespace IkonizerCore\Ash\Components\Uikit;

use IkonizerCore\IconLibrary;
use JetBrains\PhpStorm\Pure;
use IkonizerCore\Utility\Stringify;

class UikitDropdownExtension
{

    /** @var string */
    public const NAME = 'uikit_action';

    /**
     * Get the session flash messages on the fly.
     *
     * @param object|null $controllerObj
     * @param array $items
     * @param string|null $status
     * @param array $row
     * @param string|null $controller - the current controller object
     * @return string
     */
    #[Pure] public function register(
        object $controllerObj = null,
        array $items = [],
        string|null $status = null,
        array $row = [],
        string|null $controller = null): string
    {
        $element = '';
        $_controller = ($controller !==null) ? $controller : '';
        $_row = ($row) ? $row : [];
        if (is_array($items) && count($items) > 0) {
            $element .= '<div uk-dropdown="pos: left-center; mode: click">';
            $element .= '<ul class="uk-nav uk-dropdown-nav">';
            $element .= '<li class="uk-active"><a href="#">' . ($status !==null) ? Stringify::capitalize($status) : 'Status Unknown' . '</a></li>';
            foreach ($items as $key => $item) {
                $element .= '<li>';
                $element .= '<a data-turbo="false" href="'.($item['path'] ?? '') . '">';
                $element .= (isset($item['icon']) ? IconLibrary::getIcon($item['icon'], 0.9) : '');
                $element .= Stringify::capitalize($item['name']);
                $element .= '</a>';
                $element .= '</li>';
                $element .= PHP_EOL;
            }
            $element .= '<li class="uk-nav-divider"></li>';
            $element .= '<li><a data-turbo="false" href="/admin/' . $_controller . '/' . $_row['id'] . '/hard-delete" class="uk-icon-link uk-text-danger">' . IconLibrary::getIcon('trash', 1.2) . '</a></li>';
            $element .= '</ul>';
            $element .= PHP_EOL;
            $element .= '</div>';
            $element .= PHP_EOL;
        }

        return $element;
    }

}