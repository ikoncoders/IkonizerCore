<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Traits;

use IkonizerCore\Session\Flash\Flash;
use IkonizerCore\Session\Flash\FlashType;
use IkonizerCore\Session\SessionTrait;

trait ControllerFlashTrait
{

    /**
     * Conbination method which encapsulate the flashing and redirecting all within
     * a single method. Use the relevant arguments to customized the output
     *
     * @param boolean $action
     * @param string|null $redirect
     * @param string $message
     * @param string $type
     * @return void
     */
    public function flashAndRedirect(bool $action, ?string $redirect = null, string $message, string $type = FlashType::SUCCESS): void
    {
        if (is_bool($action)) {
            $this->flashMessage($message, $type);
            $this->redirect(($redirect === null) ? $this->onSelf() : $redirect);
        }
    }

    /**
     * Returns the session based flash message
     *
     * @param string $message
     * @param string $type
     * @return void
     */
    public function flashMessage(string $message, string $type = FlashType::SUCCESS)
    {
        $flash = (new Flash(SessionTrait::sessionFromGlobal()))->add($message, $type);
        if ($flash) {
            return $flash;
        }
    }

    /**
     * Returns the session based flash message type warning as string
     *
     * @return string
     */
    public function flashWarning(): string
    {
        return FlashType::WARNING;
    }

    /**
     * Returns the session based flash message type success as string
     *
     * @return string
     */
    public function flashSuccess(): string
    {
        return FlashType::SUCCESS;
    }

    /**
     * Returns the session based flash message type danger as string
     *
     * @return string
     */
    public function flashDanger(): string
    {
        return FlashType::DANGER;
    }

    /**
     * Returns the session based flash message type info as string
     *
     * @return string
     */
    public function flashInfo(): string
    {
        return FlashType::INFO;
    }


}