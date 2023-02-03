<?php
declare(strict_types=1);

namespace IkonizerCore\Cache;

use IkonizerCore\Cache\Exception\CacheException;

class CacheFacade
{

    /**
     * Undocumented function
     *
     * @param string|null $cacheIdentifier
     * @param string|null $storage
     * @param array $options
     * @return CacheInterface
     */
    public function create(
        ?string $cacheIdentifier = null,
        ?string $storage = null,
        array $options = []
    ): CacheInterface
    {
        try {
            return (new CacheFactory())->create($cacheIdentifier, $storage, $options);
        } catch(CatchException $e) {
            throw $e->getMessage();
        }
    }
}
