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
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType")
     */
    private $propertyOfferingType;

    /**
     * @var PropertyType
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyType")
     */
    private $propertyType;

    /**
     * @var FilterEnabledInterface[]
     */
   // private $filters;

    /**
     * @var array
     * @ORM\Column(type="array")
     */
    private $filtersSerialized;

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
        $filterClasses = [];
        array_walk($filters, function (FilterEnabledInterface $filter) use ($offerSearch, &$filterClasses) {
            if(get_class($filter) == PropertyOfferingType::class) {
                $offerSearch->propertyOfferingType = $filter;
            }
            else if(get_class($filter) == PropertyType::class) {
                $offerSearch->propertyType = $filter;
            }
            else {
                $filterClasses[] = $filter;
            }
        });

        $offerSearch->calculateFiltersString($filterClasses);

        return $offerSearch;
    }

    // function used to update filters - add set of filters and recalculate the flat filters
    public function updateSearchFilters(array $filters): void
    {
        $filterClasses = [];
        array_walk($filters, function (FilterEnabledInterface $filter) use (&$filterClasses) {
            if(get_class($filter) == PropertyOfferingType::class) {
                $this->propertyOfferingType = $filter;
            }
            else if(get_class($filter) == PropertyType::class) {
                $this->propertyType = $filter;
            }
            else {
                $filterClasses[] = $filter;
            }
        });

        $this->calculateFiltersString($filterClasses);
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

    public function getFiltersSerialized(): array
    {
        return $this->filtersSerialized;
    }

    /**
     * Note: I may make this entity read and replace only.
     * So, FilterEnabledInterface filter array may only serve for initialization at the moment of creation
     * without even persisting it as a class field, only to calculate serialized, "flat" filters, that represent FilterValueInterface
     * @return FilterEnabledInterface[]

    public function getFilters(): array
    {
        // calculate them from serialized filters
        foreach ($this->filtersSerialized as $filterClass => $filterValue)
        return $this->filters;
    }
    */

    public function getClient(): Client
    {
        return $this->client;
    }

    public function calculateFiltersString(array $filters)
    {
        $this->filtersSerialized = [];
        foreach ($filters as $filter) {
            if(!$filter instanceof FilterEnabledInterface) {
                throw new \InvalidArgumentException('Expected class ' . FilterEnabledInterface::class);
            }

            $this->filtersSerialized[$filter->getServiceAlias()] = $filter->getFilterableValue()->__serialize();
        }
    }
}
