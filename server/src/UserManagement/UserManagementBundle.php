<?php
declare(strict_types=1);

namespace RealDeal\UserManagement;

use RealDeal\UserManagement\DependencyInjection\UserManagementExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class UserManagementBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new UserManagementExtension();
    }
}
