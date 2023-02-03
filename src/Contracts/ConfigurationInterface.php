<?php
namespace IkonizerCore\Contracts;

interface ConfigurationInterface
{

    public function getParentConfig(): array;
    public function getConfigBundler(): array;
   // public function resolveBundlerDependencies(): void;

}
