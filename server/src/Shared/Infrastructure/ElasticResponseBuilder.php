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
                'property_total_price' => $hit['_source']['total_price.value'],
                'footage'              => $hit['_source']['footage.value'],
                'rooms'                => $hit['_source']['rooms_number'],
                'contract_type'        => $hit['_source']['property_contract_type'],
                'legal_status'         => $hit['_source']['property_legal_status'],
                'market_type'          => $hit['_source']['property_market_type'],
                'property_type'        => $hit['_source']['property_type'],
                'offering_type'        => $hit['_source']['offering_type'],
                'client_id'            => $hit['_source']['client_id']
            ];
        }, $rawResponse['hits']['hits']);

    }
}
