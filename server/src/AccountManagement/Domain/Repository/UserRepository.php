<?php
declare(strict_types=1);

namespace RealDeal\AccountManagement\Domain\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use RealDeal\AccountManagement\Domain\User;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function save(UserInterface $user): void
    {
        $em = $this->getEntityManager();
        if(!$em->contains($user)) {
            $em->persist($user);
        }

        $em->flush();
    }
}
