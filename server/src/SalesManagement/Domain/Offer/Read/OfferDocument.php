<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer\Read;

use ONGR\ElasticsearchBundle\Annotation as ES;

/**
 * @ES\Index(alias="offers", default=true)
 */
class OfferDocument
{
    /**
     * @ES\Id()
     */
    private $id;
    /**
     * @ES\Property(name="property_name", analyzer="simple_analyzer")
     */
    private $name;
    
     /**
     * @ES\Property(name="property_name")
     */
    private $totalPrice;

    public function getId(): string
    {
        return $this->id;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }


    public function setTotalPrice($totalPrice): void
    {
        $this->totalPrice = $totalPrice;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}
