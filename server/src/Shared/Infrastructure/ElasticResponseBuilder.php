<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

/**
 * @todo - make this abstract, extendable class and let specialized classes display information based on configured fields
 * Class ElasticResponseBuilder
 */
class ElasticResponseBuilder
{
    public function prepareResponse(array $rawResponse, array $displayFields = []): array
    {
        return  array_map(function($hit) {
            return [
                'doc_id'               => $hit['_id'],
                'id'                   => $hit['_source']['persisted_id'],
                'property_name'        => $hit['_source']['property_name'],
                'property_total_price' => $hit['_source']['property_total_price'] ,
                'client_id'            => $hit['_source']['client_id']
            ];
        }, $rawResponse['hits']['hits']);
        
    }
}