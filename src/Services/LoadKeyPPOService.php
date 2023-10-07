<?php

namespace Gavan4eg\StateTaxServiceUkraine\Services;

use PPOLib\KeyStore;

class LoadKeyPPOService
{
    protected function getKey()
    {
        $keydata = config('statetax.key');
        $password = config('statetax.passwordKey');

        return KeyStore::loadjks($keydata, $password);
    }

}
