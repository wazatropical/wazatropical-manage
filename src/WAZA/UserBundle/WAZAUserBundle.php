<?php

namespace WAZA\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class WAZAUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
