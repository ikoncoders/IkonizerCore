<?php

declare(strict_types=1);

namespace IkonizerCore\Auth\Contracts;

interface UserActivationInterface
{ 

    /**
     * Find and return a user object via the token provided
     *
     * @param string $token
     * @return Object|null
     */
    public function findByActivationToken(string $token) : ?Object;

    /**
     * Send an activation email when the user registration event is fired
     *
     * @param string $hash
     * @return self
     */
    public function sendUserActivationEmail(string $hash) : self;

    /**
     * Validate the user object. Ensuring the user object doesn't returned null.
     *
     * @param object|null $repository
     * @return self
     */
    public function validateActivation(?object $repository) : self;

    /**
     * Activate the user account
     *
     * @return boolean
     */
    public function activate() : bool;

}