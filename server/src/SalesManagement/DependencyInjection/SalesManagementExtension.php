<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class SalesManagementExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        //$loader = new YamlFileLoader(
        //    $container,
        //    //new FileLocator('/usr/src/app/src/SalesManagement/Infrastructure/Resources/config')
        //    new FileLocator('src/SalesManagement/Infrastructure/Resources/config')
        //);
        //$loader->load('services.yml');
    }
}