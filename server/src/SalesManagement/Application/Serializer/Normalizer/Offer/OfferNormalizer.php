<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Serializer\Normalizer\Offer;

use RealDeal\SalesManagement\Domain\Offer\Offer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OfferNormalizer implements NormalizerInterface
{
    private UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'identifier' => $object->getIdentifier(),
            'name' => $object->getName(),
            'user' => $object->getUser()->getId(),
            'totalPrice' => (string)$object->getTotalPrice(),
            'property_type' => (string)$object->getPropertyType(),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Offer;
    }
}
