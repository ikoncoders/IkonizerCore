<?php

declare(strict_types=1);

namespace IkonizerCore\Ash\Components\Uikit;

use IkonizerCore\Session\Flash\Flash;

class UikitFlashMessagesExtension
{

    /** @var string */
    public const NAME = 'uikit_flash_message';

    /**
     * @param Flash $flash
     */
    public function __construct(Flash $flash)
    {
        $this->flash = $flash;
    }

    /**
     * Get the session flash messages on the fly.
     *
     * @param object|null $controller - the current controller object
     * @return bool|string
     */
    public function register(object $controller = null): bool|string
    {
        $html = '';
        $messages = $this->flash->getSessionObject($controller->getSession())->get();
        if (is_array($messages) && count($messages) > 0) {
            foreach ($messages as $message) {
                extract($message);
                $html .= '<div class="uk-alert-' . ($type ?? '') . ' uk-animation-toggle uk-animation-fade" uk-alert tabindex="0">
                        <a class="uk-alert-close" uk-close></a>
                        <p class="uk-text-bolder">' . ($message ?? '') . '</p>
                    </div>';
                    
            }
            return $html;
        }
        return false;
    }

}