<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Query;

use RealDeal\Shared\Application\Query\ElasticQuery;
use RealDeal\SalesManagement\Domain\Offer\Read\OfferDocument;

class GetAllOffersQuery extends ElasticQuery
{
    public function execute()
    {
       $index = $this->container->get(OfferDocument::class); 
       return $index->findBy([], ['property_total_price' => 'ASC'], 10, 0);
    }
}