<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class PropertyContractType
{
    private const CONTRACT_TYPES = [
        'contract_type_1',
        'contract_type_2'
    ];

    /**
     * @ORM\Column(type="string")
     */
    private string $propertyContractType;

    public function __construct(string $contractType)
    {
        $this->setPropertyContractType($contractType);
    }

    private function setPropertyContractType(string $contractType): void
    {
        if (!in_array($contractType, self::CONTRACT_TYPES)) {
            throw new \InvalidArgumentException('unrecognized property status type: ' . $status);
        }

        $this->propertyContractType = $contractType;
    }

    public function __toString(): string
    {
        return $this->propertyLegalStatus;
    }

    public function getServiceAlias(): string
    {
        return get_class($this);
    }


}
