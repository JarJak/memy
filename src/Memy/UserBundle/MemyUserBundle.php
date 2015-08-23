<?php

namespace Memy\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MemyUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
