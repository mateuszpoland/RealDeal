<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject;

use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
final class PropertyLegalStatus
{
    private const LEGAL_STATUSES = [
        'ownership',
        'cooperative',
        'cooperative-ownership',
    ];

    /**
     * @ORM\Column(type="string")
     */
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

    public function __toString(): string
    {
        return $this->propertyLegalStatus;
    }

    public function getServiceAlias(): string
    {
        return get_class($this);
    }
}
