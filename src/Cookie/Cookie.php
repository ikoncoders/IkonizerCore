<?php

declare(strict_types=1);

namespace IkonizerCore\Cookie;

use IkonizerCore\Cookie\Store\CookieStoreInterface;

class Cookie implements CookieInterface
{

    /** @var CookieStoreInterface */
    protected CookieStoreInterface $cookieStore;

    /**
     * Protected class constructor as this class will be a singleton
     *
     * @param CookieStoreInterface $cookieStore
     */
    public function __construct(CookieStoreInterface $cookieStore)
    {
        $this->cookieStore = $cookieStore;
    }

    /**
     * @inheritdoc
     * 
     * @return bool
     */
    public function has(): bool
    {
        return $this->cookieStore->hasCookie();
    }

    /**
     * @inheritdoc
     * 
     * @param mixed $value
     * @return self
     */
    public function set(mixed $value): void
    {
        $this->cookieStore->setCookie($value);
    }

    /**
     * @inheritdoc
     * 
     * @return void
     */
    public function delete(): void
    {
        if ($this->has()) {
            $this->cookieStore->deleteCookie();
        }
    }

    /**
     * @inheritdoc
     * 
     * @return void
     */
    public function invalidate(): void
    {
        foreach ($_COOKIE as $name => $value) {
            if ($this->has()) {
                $this->cookieStore->deleteCookie($name);
            }
        }
    }
}
