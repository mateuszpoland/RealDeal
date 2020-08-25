<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\Read;

use ONGR\ElasticsearchBundle\Annotation as ES;

/**
 * @ES\Index(alias="offer", default=true)
 *
 */
class OfferDocument
{
    /**
     * @ES\Id()
     */
    private $id;

    /**
     * @ES\Property(type="text", name="persisted_id")
     */
    private $persistedId;
    /**
     * @ES\Property(type="text", name="property_name", analyzer="simple_analyzer")
     */
    private $name;
    
     /**
     * @ES\Property(type="float", name="property_total_price")
     */
    private $totalPrice;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setPersistedId(int $id)
    {
        $this->persistedId = $id;
    }

    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = $totalPrice;

    }
    
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getPersistedId(): int
    {
        return $this->persistedId;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
