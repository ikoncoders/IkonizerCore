<?php

declare(strict_types=1);

namespace IkonizerCore\Auth\Contracts;

interface UserSecurityInterface
{ 

    /**
     * Return the user object by the supplied email address
     *
     * @param string $email
     * @param integer|null $ignoreID
     * @return void
     */
    public function emailExists(string $email, int $ignoreID = null);

    /**
     * Validate a user by their password
     *
     * @param object $cleanData
     * @param object|null $repository
     * @return void
     */
    public function validatePassword(object $cleanData, ?object $repository = null);

}