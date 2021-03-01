<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command\Offer;

use RealDeal\Shared\Application\CommandInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CreateOfferCommand implements CommandInterface
{
    private string $name;
    private float $totalPrice;
    private float $footage;
    private int $numberOfRooms;
    private int $clientId;
    private string $propertyContractType;
    private string $propertyLegalStatus;
    private string $propertyMarketType;
    private string $offeringType;
    private string $propertyType;
    private \DateTime $availableFrom;
    private ?UploadedFile $uploadedFile;

    public function __construct(
        string $name,
        float $totalPrice,
        float $footage,
        int $numberOfRooms,
        int $clientId,
        string $propertyContractType,
        string $propertyLegalStatus,
        string $propertyMarketType,
        string $offeringType,
        string $propertyType,
        string $availableFrom,
        ?UploadedFile $uploadedFile
    )
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->footage = $footage;
        $this->numberOfRooms = $numberOfRooms;
        $this->clientId = $clientId;
        $this->propertyContractType = $propertyContractType;
        $this->propertyLegalStatus = $propertyLegalStatus;
        $this->propertyMarketType = $propertyMarketType;
        $this->offeringType = $offeringType;
        $this->propertyType = $propertyType;
        $this->availableFrom = new \DateTime($availableFrom);
        $this->uploadedFile = $uploadedFile;
    }

    public function __toString(): string
    {
        return get_class($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getFootage(): float
    {
        return $this->footage;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getPropertyContractType(): string
    {
        return $this->propertyContractType;
    }

    public function getPropertyLegalStatus(): string
    {
        return $this->propertyLegalStatus;
    }

    public function getPropertyMarketType(): string
    {
        return $this->propertyMarketType;
    }

    public function getOfferingType(): string
    {
        return $this->offeringType;
    }

    public function getAvailableFrom(): \DateTime
    {
        return $this->availableFrom;
    }

    public function getPropertyType(): string
    {
        return $this->propertyType;
    }

    public function getNumberOfRooms(): int
    {
        return $this->numberOfRooms;
    }

    public function addFilesToUpload(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    /**
     * @return UploadedFile|null
     */
    public function getUploadedFile(): ?UploadedFile
    {
        return $this->uploadedFile;
    }
}
