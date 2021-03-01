<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Repository\Offer;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class OfferPhotosRepository implements ServiceEntityRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
