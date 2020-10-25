<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

class PropertyContractType implements FilterEnabledInterface
{
    public const FILTER_ALIAS = 'property_contract_type';

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

    public function __toString(): string
    {
        return $this->propertyLegalStatus;
    }

    public function getServiceAlias(): string
    {
        return self::FILTER_ALIAS;
    }


}
