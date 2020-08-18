<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement;

use RealDeal\SalesManagement\DependencyInjection\SalesManagementExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SalesManagementBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SalesManagementExtension();
    }
}