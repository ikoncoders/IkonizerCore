<?php

declare (strict_types = 1);

namespace IkonizerCore\Ash;

interface TemplateInterface
{

    /**
     * Undocumented function
     *
     * @param string $file
     * @param array $context
     * @return void
     */
    public function view(string $file, array $context = []);

}
