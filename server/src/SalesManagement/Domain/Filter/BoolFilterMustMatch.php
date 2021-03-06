<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\FullText\MatchQuery;

class BoolFilterMustMatch extends StringFilterValue
{
    public function createElasticQueryFromFilter(): array
    {
        return [ BoolQuery::MUST => new MatchQuery($this->elasticFieldName, $this->filterValue)];
    }
}
