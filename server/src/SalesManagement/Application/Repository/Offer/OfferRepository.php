<?php

namespace RealDeal\SalesManagement\Application\Repository\Offer;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use RealDeal\SalesManagement\Domain\Offer\Offer;

class OfferRepository implements ServiceEntityRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findById(): Offer
    {
       throw new Exception('Not implemented yet');
    }
}