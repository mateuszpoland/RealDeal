<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter\Offer\Category;

use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyType;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Filter\OfferSearchRepository")
 * @ORM\Table(name="client_search_offer")
 */
class OfferSearch
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var PropertyOfferingType
     * @ORM\Column(type="string", nullable=false)
     */
    private $propertyOfferingType;

    /**
     * @var PropertyType
     * @ORM\Column(type="string", nullable=false)
     */
    private $propertyType;

    /**
     * @var FilterEnabledInterface[]
     * @ORM\Column(type="array")
     */
    private $filters;

    /**
     * @var Client
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Client\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    private function __construct(
        Client $client
    )
    {
        $this->client = $client;
    }

    public static function createFromFilters(Client $client, array $filters): self
    {
        $offerSearch = new self($client);
        array_walk($filters, function (FilterEnabledInterface $filter) use ($offerSearch) {
            if(get_class($filter) == PropertyOfferingType::class) {
                $offerSearch->propertyOfferingType = $filter;
            }
            else if(get_class($filter) == PropertyType::class) {
                $offerSearch->propertyType = $filter;
            }
            else {
                $offerSearch->filters[] = $filter;
            }
        });

        return $offerSearch;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPropertyOfferingType(): PropertyOfferingType
    {
        return $this->propertyOfferingType;
    }

    public function getPropertyType(): PropertyType
    {
        return $this->propertyType;
    }

    /**
     * @return FilterEnabledInterface[]
     */
    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function addFilter(FilterEnabledInterface $filter): void
    {
        if(!in_array($filter, $this->filters)) {
            $this->filters[] = $filter;
        }
    }

    public function removeFilter(FilterEnabledInterface $filter): void
    {
        if(in_array($filter, $this->filters)) {
            unset($this->filters[$filter]);
        }
    }
}
