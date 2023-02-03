<?php

declare(strict_types=1);

namespace IkonizerCore\Cookie\Store;

interface CookieStoreInterface
{

    /**
     * @return bool
     */
    public function hasCookie(): bool;

    /**
     * @param mixed $value
     * @return void
     */
    public function setCookie(mixed $value): void;

    /**
     * @param null|string $cookieName
     * @return void
     */
    public function deleteCookie(string|null $cookieName = null): void;
}
