<?php
namespace IkonizerCore\CommanderBar;

trait CommanderUnsetterTrait
{

    /**
     * @return array
     */
    public function unsetCommander(): array
    {
        return $this->noCommander;
    }

    /**
     * @return array
     */
    public function unsetNotification(): array
    {
        return $this->noNotification;
    }

    /**
     * @return array
     */
    public function unsetManager(): array
    {
        return $this->noManager;
    }

    /**
     * @return array
     */
    public function unsetCustomizer(): array
    {
        return $this->noCustomizer;
    }

    /**
     * @return array
     */
    public function unsetAction(): array
    {
        return $this->noAction;
    }

    /**
     * @return array
     */
    public function unsetFilter(): array
    {
        return $this->noFilter;
    }

}