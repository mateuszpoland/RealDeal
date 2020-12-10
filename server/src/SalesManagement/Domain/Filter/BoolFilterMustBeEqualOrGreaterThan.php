<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\RangeQuery;

class BoolFilterMustBeEqualOrGreaterThan extends FloatFilterValue
{
    public function createElasticQueryFromFilter(): array
    {
        return [ BoolQuery::MUST => new RangeQuery(
            $this->elasticFieldName,
            [
                'gte' => $this->filterValue,
                'boost' => 2.0
            ]
        )
        ];
    }
}
