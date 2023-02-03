<?php

declare(strict_types=1);

namespace IkonizerCore\CurlApi\Actions;

use IkonizerCore\CurlApi\CurlTrait;

class CurlDelete
{

    /**
     * Curl RestAPi for deleting a resource
     * @param $ch
     * @param string $path
     * @param mixed|null $data
     * @param array $headers
     * @return $this
     */
    public function endpointDelete($ch, string $path, mixed $data = null, array $headers = []): self
    {
        curl_setopt($ch, CURLOPT_URL, $path);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        return $this;
    }

}
