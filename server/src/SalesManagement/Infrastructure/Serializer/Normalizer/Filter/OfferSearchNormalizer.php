<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Serializer\Normalizer\Filter;

use RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch;
use RealDeal\SalesManagement\Infrastructure\Serializer\Normalizer\Client\ClientNormalizer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Interfaces\FilterEnabledInterface;

class OfferSearchNormalizer implements NormalizerInterface
{
    private UrlGeneratorInterface $router;
    private ClientNormalizer $clientNormalizer;

    public function __construct(UrlGeneratorInterface $router, ClientNormalizer $clientNormalizer)
    {
        $this->router = $router;
        $this->clientNormalizer = $clientNormalizer;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        return [
            'id'                     => $object->getId(),
            'client'                 => $this->normalizeClient($object->getClient()),
            'property_offering_type' => $object->getPropertyOfferingType()->__toString(),
            'property_type'          => $object->getPropertyType()->__toString(),
            'filters'                 => array_map(function (FilterEnabledInterface $filter) {
                return [
                    $filter->getServiceAlias() => $filter
                ];
            }, $object->getFilters())
        ];
    }

    private function normalizeClient(Client $client)
    {
        return $this->clientNormalizer->normalize($client, null, ['base_data']);
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof OfferSearch;
    }

}
