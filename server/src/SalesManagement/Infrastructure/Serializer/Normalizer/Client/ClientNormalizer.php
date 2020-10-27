<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Infrastructure\Serializer\Normalizer\Client;

use RealDeal\SalesManagement\Domain\Client\Client;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use RealDeal\SalesManagement\Domain\Offer\Offer;

class ClientNormalizer implements NormalizerInterface
{
    private UrlGeneratorInterface $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
        $data = [
            'id'                    => $object->getId(),
            'name'                  => $object->getName(),
            'secondName'            => $object->getSecondName(),
            'email'                 => $object->getEmail(),
            'stage'                 => $object->getStage(),
            'ownedProperties'       => array_map(function (Offer $property) {
                return [
                    'id'   => $property->getId(),
                    'name' => $property->getName(),
                    'href' => $this->router->generate('salesManagement.getSingleOffer',
                        ['id' => $property->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL)
                ];
            }, $object->getOwnedProperties()->toArray()),
            'prospectiveProperties' => array_map(function (Offer $property) {
                return [
                    'id'   => $property->getId(),
                    'name' => $property->getName(),
                    'href' => $this->router->generate('salesManagement.getSingleOffer',
                        ['id' => $property->getId()],
                        UrlGeneratorInterface::ABSOLUTE_URL)
                ];
            }, $object->getProspectiveProperties()->toArray())
        ];
        $data['href']['self'] = $this->router->generate('salesManagement.getClient', [
            'id' => $object->getId()
        ], UrlGeneratorInterface::ABSOLUTE_URL);

        $context = array_flip($context);

        if(isset($context['base_data'])) {
            return array_intersect_key($data, array_flip(['id', 'href']));
        }

        return $data;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Client;
    }
}
