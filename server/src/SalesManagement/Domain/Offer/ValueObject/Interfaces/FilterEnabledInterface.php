<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces;

use RealDeal\SalesManagement\Domain\Filter\ElasticFilterInterface;

interface FilterEnabledInterface extends \Serializable
{
    /**
     * Alias is being used as a key in registry
     * @return string
     */
    public function getServiceAlias(): string;

    /**
     * Gets a key representing field in ElasticSearch document
     * @return string
     */
    public function getElasticFieldName(): string;

    /**
     * Get value object that elastic query can be extracted from
     * @return ElasticFilterInterface|null
     */
    public function getFilterableValue(): ?ElasticFilterInterface;
}
