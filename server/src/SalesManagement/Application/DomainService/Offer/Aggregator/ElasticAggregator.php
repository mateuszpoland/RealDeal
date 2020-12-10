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
        $mainQuery = new BoolQuery();
        $nonBaseFilterObjects = $offerSearch->getFilterObjects();

        if($nonBaseFilterObjects) {
            foreach ($nonBaseFilterObjects as $nonBaseFilterObject) {
                $filters[] = $nonBaseFilterObject
                    ->getFilterableValue()
                    ->createElasticQueryFromFilter();
            }
        }

        $filters[] = $offerSearch
            ->getPropertyType()
            ->getFilterableValue()
            ->createElasticQueryFromFilter();

        $filters[] = $offerSearch
            ->getPropertyOfferingType()
            ->getFilterableValue()
            ->createElasticQueryFromFilter();

        foreach ($filters as $filter) {
            $key = key($filter);
            $mainQuery->add($filter[$key], $key);
        }

        // check what boost actaully is
        $mainQuery->addParameter('boost', 1);

        $search = new Search();
        $search->addQuery($mainQuery);

        $params = [
            'index' => 'offers',
            'body' => $search->toArray()
        ];

        $results = $client->search($params);
        return $results;
    }
}
