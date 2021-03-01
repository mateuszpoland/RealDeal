<?php
declare(strict_types=1);

namespace RealDeal\UserManagement;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use RealDeal\UserManagement\DependencyInjection\UserAuthenticationExtension;

class UserManagementBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserAuthenticationExtension();
    }
}
