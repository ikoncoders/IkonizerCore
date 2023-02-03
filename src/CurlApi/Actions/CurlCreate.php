<?php

declare(strict_types=1);

namespace IkonizerCore\CurlApi\Actions;

use IkonizerCore\CurlApi\CurlTrait;

class CurlCreate
{

    /**
     * Curl RestAPi for creating a resource
     * @param $ch
     * @param string $path
     * @param mixed|null $data
     * @param array $headers
     * @return $this
     */
    public function endpointCreate($ch, string $path, mixed $data = null, array $headers = []): self
    {
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        return $this;
    }

}