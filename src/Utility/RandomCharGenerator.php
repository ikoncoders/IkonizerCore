<?php
 
declare(strict_types=1);

namespace IkonizerCore\Utility;

class RandomCharGenerator
{

    /**
     * Generate a random character string default to 12 characters. Can be used to generate
     * random characters to use a password, hash etc..
     * 
     * @param int $length
     * @param boolean $specialChars defaults to true
     * @return string
     */
    public static function generate(int $length = 12, bool $specialChars = true) : string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($specialChars) {
            $chars .= '!@#$%^&*()';
        }
        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $random;

    }

    public static function randomNumberGenerator($requiredLength = 7, $highestDigit = 8): string
    {
        $sequence = '';
        for ($i = 0; $i < $requiredLength; ++$i) {
            $sequence .= mt_rand(0, $highestDigit);
        }
        return $sequence;
    }


}
