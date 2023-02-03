<?php
declare(strict_types=1);

namespace IkonizerCore\CurlApi\Actions;

use IkonizerCore\CurlApi\CurlTrait;

class CurlEdit
{

    /**
     * Curl RestAPi for editting a resource
     * @param $ch
     * @param string $path
     * @param mixed|null $data
     * @param array $headers
     * @return $this
     */
    public function endpointEdit($ch, string $path, mixed $data = null, array $headers = []): self
    {
        curl_setopt($ch, CURLOPT_URL, $path . '' . $data);
        return $this;
    }

}