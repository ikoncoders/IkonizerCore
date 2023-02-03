<?php
namespace IkonizerCore\Base\Traits;

use IkonizerCore\Utility\Serializer;

trait ControllerSessionTrait
{


    public function getSessionData(?string $sessionKey = null, ?object $controller = null): array|bool
    {
        $data = $controller->getSession()->get($sessionKey);
        $uncompressSession = Serializer::unCompress($data);
        if (is_array($uncompressSession) && count($uncompressSession) > 0) {
            return $uncompressSession;
        }

        return false;
    }

    public function resolveAdditionalConditions(string $key = null, object $controller = null)
    {
        return $this->getSessionData($key, $controller)['additional_conditions'];
    }

}
