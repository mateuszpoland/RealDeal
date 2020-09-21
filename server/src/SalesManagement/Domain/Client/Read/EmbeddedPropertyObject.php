<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Client\Read;

use ONGR\ElasticsearchBundle\Annotation as ES;
/**
 * Class EmbeddedPropertyObject
 * Class used as an object embedded in document, for searching. Acts like relation to other index.
 * @ES\ObjectType
 */
class EmbeddedPropertyObject
{
    /**
     * @ES\Property(type="text")
     */
    private $id;

    /**
     * @ES\Property(type="text")
     */
    private $name;

    /**
     * @ES\Property(type="float")
     */
    private float $price;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}