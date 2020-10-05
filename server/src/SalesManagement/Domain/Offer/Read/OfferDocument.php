<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\Read;

use ONGR\ElasticsearchBundle\Annotation as ES;

/**
 * @ES\Index(alias="offers", default=true)
 */
class OfferDocument
{
    /**
     * @ES\Id()
     */
    private $id;

    /**
     * @ES\Property(type="integer", name="persisted_id")
     */
    private int $persistedId;
    /**
     * @ES\Property(type="text", name="property_name", analyzer="simple_analyzer")
     */
    private string $name;

     /**
     * @ES\Property(type="float", name="property.total_price.value")
     */
    private float $totalPriceValue;

    /**
     * @ES\Property(type="text", name="property.total_price.currency")
     */
    private string $totalPriceCurrency;

    /**
     * @ES\Property(type="float", name="property.footage.value")
     */
    private float $footage;

    /**
     * @ES\Property(type="text", name="property.footage.unit")
     */
    private string $footageUnit;

    /**
     * @ES\Property(type="integer", name="client_id")
     */
    private int $ownerId;

    /**
     * @ES\Property(type="text", name="contract_type")
     */
    private string $propertyContractType;

    /**
     * @ES\Property(type="text", name="legal_status")
     */
    private string $propertyLegalStatus;

    /**
     * @ES\Property(type="text", name="market_type")
     */
    private string $propertyMarketType;

    /**
     * @ES\Property(type="text", name="offering_type")
     */
    private string $propertyOfferingType;


    public function getOwnerId()
    {
        return $this->ownerId;
    }

    public function setOwnerId($clientId): void
    {
        $this->ownerId = $clientId;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setPersistedId(int $id)
    {
        $this->persistedId = $id;
    }

    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = $totalPrice;

    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getPersistedId(): int
    {
        return $this->persistedId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPriceValue(): float
    {
        return $this->totalPriceValue;
    }

    public function setTotalPriceValue(float $totalPriceValue): void
    {
        $this->totalPriceValue = $totalPriceValue;
    }

    /**
     * @return string
     */
    public function getTotalPriceCurrency(): string
    {
        return $this->totalPriceCurrency;
    }

    public function setTotalPriceCurrency(string $totalPriceCurrency): void
    {
        $this->totalPriceCurrency = $totalPriceCurrency;
    }

    public function getFootage(): float
    {
        return $this->footage;
    }

    public function setFootage(float $footage): void
    {
        $this->footage = $footage;
    }

    public function getFootageUnit(): string
    {
        return $this->footageUnit;
    }

    public function setFootageUnit(string $footageUnit): void
    {
        $this->footageUnit = $footageUnit;
    }

    public function getPropertyContractType(): string
    {
        return $this->propertyContractType;
    }

    public function setPropertyContractType(string $propertyContractType): void
    {
        $this->propertyContractType = $propertyContractType;
    }

    public function getPropertyLegalStatus(): string
    {
        return $this->propertyLegalStatus;
    }

    public function setPropertyLegalStatus(string $propertyLegalStatus): void
    {
        $this->propertyLegalStatus = $propertyLegalStatus;
    }

    public function getPropertyMarketType(): string
    {
        return $this->propertyMarketType;
    }

    public function setPropertyMarketType(string $propertyMarketType): void
    {
        $this->propertyMarketType = $propertyMarketType;
    }

    public function getPropertyOfferingType(): string
    {
        return $this->propertyOfferingType;
    }

    public function setPropertyOfferingType(string $propertyOfferingType): void
    {
        $this->propertyOfferingType = $propertyOfferingType;
    }
}
