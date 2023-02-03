<?php
 
declare(strict_types=1);

namespace IkonizerCore\Utility;

class HashGenerator
{

    /**
     * Generate an activation hash string. When a new item needs hashing before entering
     * teh database.
     * 
     * @return array
     */
    public static function hash() : array
    {

        $token = new Token();
        $tokenhash = $token->getHash();
        $activationHash = $token->getValue();

        return [
            $tokenhash, 
            $activationHash
        ];

    }

}
