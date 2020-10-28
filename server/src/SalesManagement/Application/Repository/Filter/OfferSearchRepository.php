<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Repository\Filter;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch;

class OfferSearchRepository implements ServiceEntityRepositoryInterface
{
    private EntityManagerInterface $em;

    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->em = $em;
    }

    public function save(OfferSearch $offerSearch): void
    {
        $this->em->persist($offerSearch);
        $this->em->flush();
    }

    public function saveBatch(): void
    {
        throw new \Exception('Not implemented');
    }

    public function findForClient(int $clientId)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('cso')
            ->from('RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch', 'cso')
            ->join('RealDeal\SalesManagement\Domain\Client\Client', 'c', 'c.id = cso.client_id')
            ->where(
                $qb->expr()->eq('c.id', ':clientId')
            );

        $qb->setParameter('clientId', $clientId);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
