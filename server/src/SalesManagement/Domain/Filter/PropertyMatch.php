<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Offer\Offer;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Filter\PropertyMatchRepository")
 */
class PropertyMatch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="float")
     */
    private float $matchPercent;

    /**
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Client\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private Client $client;

    /**
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Offer\Offer")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id")
     */
    private Offer $property;

    public function __construct(
        Client $client,
        Offer $offer,
        float $matchPercent
    )
    {
        $this->client = $client;
        $this->property = $offer;
        $this->matchPercent = $matchPercent;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMatchPercent(): float
    {
        return $this->matchPercent;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getProperty(): Offer
    {
        return $this->property;
    }
}
