<?php
declare(strict_types=1);

namespace RealDeal\Shared\Infrastructure;

class ElasticResponseBuilder
{
    public function prepareResponse(array $rawResponse): array
    {
        return  array_map(function($hit) {
            return [
                'doc_id'               => $hit['_id'],
                'id'                   => $hit['_source']['persisted_id'],
                'property_name'        => $hit['_source']['property_name'],
                'property_total_price' => $hit['_source']['property_total_price'] 
            ];
        }, $rawResponse['hits']['hits']);
        
    }
}