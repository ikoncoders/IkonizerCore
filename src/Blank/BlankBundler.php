<?php
namespace IkonizerCore\Blank;

use IkonizerCore\Bundler\Bundler;
use IkonizerCore\Bundler\BundlerInterface;

class BlankBundler extends Bundler implements BundlerInterface
{

    public static function register(): array
    {
        return BlankConfigurations::configurations()['bundler'];
    }

    public static function unregister(): void
    {
        $bundle = BlankConfigurations::configurations()['bundler'];
        unset($bundle);
    }
}