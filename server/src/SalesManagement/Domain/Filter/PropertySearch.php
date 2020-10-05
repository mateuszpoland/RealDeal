<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Filter\ValueObject\PriceRange;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyLegalStatus;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyMarketType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyContractType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Filter\PropertySearchRepository")
 */
class PropertySearch
{
    private Client $client;

    private string $propertyStatus;

    private string $propertyType;

    private PropertyMarketType $propertyMarketType;

    private PropertyLegalStatus $propertyLegalStatus;

    private PropertyContractType $propertyAgreementType;

    private PropertyOfferingType $propertyOfferingType;

    private \DateTime $availableFrom;

    private array $preferredLocations = [];

    private array $excludedLocations;

    private PriceRange $priceRange;

    private array $notes = [];

    public function __construct()
    {

    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }

    public function getPropertyStatus(): string
    {
        return $this->propertyStatus;
    }

    public function setPropertyStatus(string $propertyStatus): void
    {
        $this->propertyStatus = $propertyStatus;
    }

    public function getPropertyType(): string
    {
        return $this->propertyType;
    }

    public function setPropertyType(string $propertyType): void
    {
        $this->propertyType = $propertyType;
    }

    public function getPropertyMarketType(): PropertyMarketType
    {
        return $this->propertyMarketType;
    }

    public function setPropertyMarketType(PropertyMarketType $propertyMarketType): void
    {
        $this->propertyMarketType = $propertyMarketType;
    }

    public function getPropertyLegalStatus(): PropertyLegalStatus
    {
        return $this->propertyLegalStatus;
    }

    public function setPropertyLegalStatus(PropertyLegalStatus $propertyLegalStatus): void
    {
        $this->propertyLegalStatus = $propertyLegalStatus;
    }

    public function getPropertyAgreementType(): PropertyAgreementType
    {
        return $this->propertyAgreementType;
    }

    public function setPropertyAgreementType(PropertyAgreementType $propertyAgreementType): void
    {
        $this->propertyAgreementType = $propertyAgreementType;
    }

    public function getAvailableFrom(): \DateTime
    {
        return $this->availableFrom;
    }

    public function setAvailableFrom(\DateTime $availableFrom): void
    {
        $this->availableFrom = $availableFrom;
    }

    public function getPreferredLocations(): array
    {
        return $this->preferredLocations;
    }

    public function setPreferredLocations(array $preferredLocations): void
    {
        $this->preferredLocations = $preferredLocations;
    }

    public function getExcludedLocations(): array
    {
        return $this->excludedLocations;
    }

    public function setExcludedLocations(array $excludedLocations): void
    {
        $this->excludedLocations = $excludedLocations;
    }

    public function getPriceRange(): PriceRange
    {
        return $this->priceRange;
    }

    public function setPriceRange(PriceRange $priceRange): void
    {
        $this->priceRange = $priceRange;
    }

    public function getNotes(): array
    {
        return $this->notes;
    }

    public function setNotes(array $notes): void
    {
        $this->notes = $notes;
    }

    public function equals(PropertySearch $object): bool
    {
        // todo
    }

    public function getPropertyOfferingType(): PropertyOfferingType
    {
        return $this->propertyOfferingType;
    }

    public function setPropertyOfferingType(PropertyOfferingType $propertyOfferingType): void
    {
        $this->propertyOfferingType = $propertyOfferingType;
    }


}
