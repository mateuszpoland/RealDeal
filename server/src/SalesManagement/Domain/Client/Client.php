<?php

namespace RealDeal\SalesManagement\Domain\Client;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Client
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Domain\Repository\Client\ClientRepository")
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;
}