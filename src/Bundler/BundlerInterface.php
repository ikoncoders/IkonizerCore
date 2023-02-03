<?php

namespace IkonizerCore\Bundler;

interface BundlerInterface
{

    public static function register(): array;
    public static function unregister(): void;

}