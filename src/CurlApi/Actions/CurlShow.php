<?php

declare(strict_types=1);

namespace IkonizerCore\CurlApi\Actions;

use IkonizerCore\CurlApi\CurlTrait;

class CurlShow
{

    /**
     * Curl RestAPi for returning a single resource
     * @param $ch
     * @param string $path
     * @param mixed|null $data
     * @param array $headers
     * @return $this
     */
    public function endpointShow($ch, string $path, mixed $data = null, array $headers = []): self
    {
        curl_setopt($ch, CURLOPT_URL, $path . '' . $data);
        return $this;
    }

}
