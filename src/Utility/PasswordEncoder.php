<?php
 
declare(strict_types=1);

namespace IkonizerCore\Utility;

class PasswordEncoder
{

    use UtilityTrait;

    /**
     * PHP password algo
     */
    private const DEFAULT  = PASSWORD_DEFAULT;
    private const BCRYPT   = PASSWORD_BCRYPT ;
    private const ARGON2I  = PASSWORD_ARGON2I;
    private const ARGON2ID = PASSWORD_ARGON2ID;

    /**
     * Allows the user to set the password_hash algo from the app.yml file. the acript
     * by default will use PHP PASSWORD_DEFAULT algo
     *
     * @return string
     */
    private static function algo(): string
    {
        $algo = self::appSecurity('password_algo');
        if ($algo) {
            return match($algo) {
                'default'  => self::DEFAULT,
                'bcrypt'   => self::BCRYPT,
                'argon2i'  => self::ARGON2I,
                'argon2id' => self::ARGON2ID
            };
        }
    }

    /**
     *
     * @param string $password
     * @return string
     */
    public static function encode(string $password) : string
    {
        if (self::appSecurity('encript_password') === false) {
            return $password;
        }
        static $encodedPassword = null;
        if ($encodedPassword === null) {
            if (!empty($password)) {
                $encodedPassword = password_hash(
                    $password, 
                    PASSWORD_BCRYPT, 
                    self::appSecurity('hash_cost_factor')
                );
            } else {
                $encodedPassword = '';
            }    
        }
        return $encodedPassword;

    }

}
