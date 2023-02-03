<?php

declare(strict_types=1);

namespace IkonizerCore\Utility;

class Validator
{

    /**
     * Undocumented function
     *
     * @param string $email
     * @return mixed
     */
    public static function email(string $email)
    {
        if (!empty($email)) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    }

    /**
     * Undocumented function
     *
     * @param string $url
     * @return mixed
     */
    public static function url(string $email)
    {
        if (!empty($url)) {
            return filter_var($url, FILTER_VALIDATE_URL);
        }
    }

}

