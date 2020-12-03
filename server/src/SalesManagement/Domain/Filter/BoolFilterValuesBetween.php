<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;


use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\RangeQuery;

class BoolFilterValuesBetween extends ArrayFilterValue
{
    public function createElasticFilterQuery(): array
    {
        $from = $this->filterValue['from'];
        $to = $this->filterValue['to'];
        return [
            BoolQuery::SHOULD => new RangeQuery($this->elasticFieldName, ['gte', $from]),
            BoolQuery::MUST   => new RangeQuery($this->elasticFieldName, ['lte', $to])
        ];
    }
}
