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

    public function findById(int $id): Offer
    {
       $qb = $this->em->createQueryBuilder();
       $qb->select('o')
           ->from('RealDeal\SalesManagement\Domain\Offer\Offer', 'o')
           ->where(
                $qb->expr()->eq('o.id', ':id')
           );
       $qb->setParameter('id', $id);

       return $qb->getQuery()->getResult();
    }

    public function findAllByIds(array $ids): array
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('o')
            ->from('RealDeal\SalesManagement\Domain\Offer\Offer', 'o')
            ->where(
                $qb->expr()->in('o.id', ':ids')
            );
        $qb->setParameter('ids', $ids);

        return $qb->getQuery()->getResult();
    }

    public function save(Offer $offer): void
    {
       if(!$this->em->contains($offer)) {
           $this->em->persist($offer);
       }
       $this->em->flush();
    }

    public function delete(Offer $offer): void
    {
       $this->em->remove($offer);
       $this->em->flush();
    }
}
