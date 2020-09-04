<?php

declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Query;

use Elasticsearch\ClientBuilder;
use Exception;
use ONGR\ElasticsearchDSL\Query\MatchAllQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\IdsQuery;
use ONGR\ElasticsearchDSL\Query\TermLevel\TermQuery;
use ONGR\ElasticsearchDSL\Search;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;

class GetSingleOfferQuery
{
    private $container;

    /** @var string|null */
    private $offerId;

    public function __construct($container)
    {
        $this->container = $container;
    }
    public function execute()
    {
        if(!$this->offerId) {
            throw new Exception('Missing search parameter: doc_id');
        }
        $indexService = $this->container->get(OfferDocument::class); 
        $client = $indexService->getClient();
        // top level containing object
        $search = new Search();
        $search->addQuery(new IdsQuery([$this->offerId]));
        $params = [
            'index' => 'offers',
            'body' => $search->toArray()
        ];
        return $client->search($params);
    }

    /**
     * Sets doc_id as a search parameter
     */
    public function byDocumentId(string $docId): self
    {
        $this->offerId = $docId;
        return $this;
    }
}