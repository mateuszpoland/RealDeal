<?php
declare(strict_types=1);

namespace RealDeal\UserAuthentication;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use RealDeal\UserAuthentication\DependencyInjection\UserAuthenticationExtension;

class UserAuthenticationBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserAuthenticationExtension();
    }
}
