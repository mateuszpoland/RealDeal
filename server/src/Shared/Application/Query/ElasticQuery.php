<?php
declare(strict_types=1);

namespace RealDeal\Shared\Application\Query;

use Symfony\Component\DependencyInjection\Container;

abstract class ElasticQuery
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function execute();
}