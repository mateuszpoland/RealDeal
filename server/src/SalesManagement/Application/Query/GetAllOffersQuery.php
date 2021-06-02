<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Query;

use ONGR\ElasticsearchDSL\Query\MatchAllQuery;
use ONGR\ElasticsearchDSL\Search;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;

class GetAllOffersQuery
{
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
    public function execute()
    {
        $indexService = $this->container->get(OfferDocument::class);
        $client = $indexService->getClient();
        $search = new Search();
        $search->addQuery(new MatchAllQuery());
        $params = [
            'index' => 'offers',
            'body' => $search->toArray()
        ];
        return $client->search($params);
    }
}
