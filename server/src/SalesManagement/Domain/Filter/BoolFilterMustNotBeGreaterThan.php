<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\RangeQuery;

class BoolFilterMustNotBeGreaterThan extends FloatFilterValue
{
    public function createElasticQueryFromFilter(): array
    {
        return [ BoolQuery::MUST_NOT => new RangeQuery($this->elasticFieldName, ['gt', $this->filterValue])];
    }
}
