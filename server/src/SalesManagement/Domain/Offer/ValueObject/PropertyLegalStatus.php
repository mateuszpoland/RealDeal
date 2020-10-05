<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;


final class PropertyLegalStatus
{
    private const LEGAL_STATUSES = [
        'ownership',
        'cooperative',
        'cooperative-ownership',
    ];

    private $propertyLegalStatus;

    public function __construct(string $status)
    {
        $this->setPropertyLegalStatus($status);
    }

    private function setPropertyLegalStatus(string $status): void
    {
        if (!in_array($status, self::LEGAL_STATUSES)) {
            throw new \InvalidArgumentException('unrecognized property status type: ' . $status);
        }
        $this->propertyLegalStatus = $status;
    }
}
