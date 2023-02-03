<?php
declare(strict_types=1);

namespace IkonizerCore\CurlApi;

interface CurlApiInterface
{

    /**
     *
     * @return $this
     */
    public function create(): self;

    public function read(): self;

    public function update(): self;

    public function delete(): self;

    public function show(): self;


}