<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

class PropertyContractType
{
    private const CONTRACT_TYPES = [
        'contract_type_1',
        'contract_type_2'
    ];

    private string $propertyLegalStatus;

    public function __construct(string $contractType)
    {
        $this->setPropertyContractType($contractType);
    }

    private function setPropertyContractType(string $contractType): void
    {
        if (!in_array($contractType, self::CONTRACT_TYPES)) {
            throw new \InvalidArgumentException('unrecognized property status type: ' . $status);
        }
        $this->propertyLegalStatus = $contractType;
    }
}
