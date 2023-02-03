<?php
declare(strict_types=1);

namespace IkonizerCore\Cache\Storage;

use Iterator;

interface IterableStorageInterface extends CacheStorageInterface, Iterator
{
}
