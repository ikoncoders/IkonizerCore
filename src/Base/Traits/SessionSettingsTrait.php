<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Traits;

use IkonizerCore\Utility\Serializer;

trait SessionSettingsTrait
{

    public function createSessionSettings(object $controller = null, string $key = null, mixed $data = null): void
    {
        $session = $controller->getSession();
        if (!$session->has($key)) {
            $session->set($key, Serializer::compress($data));
        }      
    }

    public function getSessionSettings(object $controller = null, string $key = null): mixed
    {
        $session = $controller->getSession();
        if ($session->has($key)) {
            $data = Serializer::unCompress($session->get($key));
        }      

        return $data;
    }

    public function flushSessionSettings(object $controller = null, string $key = null, mixed $data = null): void
    {
        $session = $controller->getSession();
        $session->delete($key);
        $session->set($key, Serializer::compress($data));
    }


}

