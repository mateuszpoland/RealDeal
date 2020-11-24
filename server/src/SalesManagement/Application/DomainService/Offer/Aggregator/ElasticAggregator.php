<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\DomainService\Offer\Aggregator;

use ONGR\ElasticsearchDSL\Query\Compound\BoolQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\RangeQuery;
use ONGR\ElasticsearchDSL\Search;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;
use Symfony\Component\DependencyInjection\Container;
use RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch;

class ElasticAggregator
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function getPropertyMatchesForFilter(OfferSearch $offerSearch): array
    {
        $indexService = $this->container->get(OfferDocument::class);
        $client = $indexService->getClient();

        // must match:
        $propertyType = $offerSearch->getPropertyType();
        //$propertyOfferingType = $offerSearch->getPropertyOfferingType()->getFilterableValue();

        //var_dump($propertyType);
        var_dump($propertyType->getFilterableValue());
       // var_dump($propertyOfferingType);
        die;

        // rest of filters;

        $mainQuery = new BoolQuery();
        $filters = [
            BoolQuery::MUST_NOT => new RangeQuery('total_price.value', ['gt' => 230000]),
            BoolQuery::MUST     => new RangeQuery('rooms_number', ['gte' => 2]),
          // client must not be the same  BoolQuery::MUST_NOT => new
        ];

        // check what boost actaully is
        $mainQuery->addParameter('boost', 1);

        foreach ($filters as $type => $filter) {
            $mainQuery->add($filter, $type);
        }

        $search = new Search();
        $search->addQuery($mainQuery);

        $params = [
            'index' => 'offers',
            'body' => $search->toArray()
        ];

       // var_dump($search->toArray());
       // die;
        $results = $client->search($params);
        return $results;
    }
}
