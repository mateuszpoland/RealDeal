<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

interface ElasticFilterInterface
{
    /**
     * @return array
     * Returns an array needed to construct ElasticSearch query
     * Example:
     * [
     *   'value' => "house",
     *   'type'  => BoolQuery::MUST_NOT
     * ]
     */
    public function __serialize(): array;
    public function __unserialize(array $parameters): self;
}
