<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Serializer\Normalizer\Offer;

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
        $data = [
            'id' => $object->getId(),
            'name' => $object->getName()
        ];

        return $data;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Offer;
    }
}
