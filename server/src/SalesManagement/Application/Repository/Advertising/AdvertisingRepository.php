<?php

namespace RealDeal\SalesManagement\Application\Repository\Advertising;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use RealDeal\SalesManagement\Domain\Advertising\Advertising;

class AdvertisingRepository implements ServiceEntityRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findById(): Advertising
    {
       throw new Exception('Not implemented yet');
    }
}