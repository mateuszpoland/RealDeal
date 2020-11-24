<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Filter;

use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;

class BoolFilterMustMatch extends StringFilterValue
{
    public function createElasticQueryFromFilter(): array
    {
        return [];
    }

}
