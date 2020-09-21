<?php

namespace RealDeal\SalesManagement\Application\Repository\Client;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use RealDeal\SalesManagement\Domain\Client\Client;

class ClientRepository implements ServiceEntityRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function findById(int $id): ?Client
    {
       $qb = $this->em->createQueryBuilder();
       $qb->select('c')
           ->from('RealDeal\SalesManagement\Domain\Client\Client', 'c')
           ->where(
               $qb->expr()->eq('c.id', ':id')
           );
       $qb->setParameter('id', $id);

       return $qb->getQuery()->getOneOrNullResult();
    }

    public function save(Client $client): void
    {
        $this->em->persist($client);
        $this->em->flush();
    }

    public function delete(Client $client): void
    {
        $this->em->remove($client);
        $this->em->flush();
    }
}