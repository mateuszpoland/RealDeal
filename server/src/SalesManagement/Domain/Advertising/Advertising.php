<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Advertising;

use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Offer\Offer;

/**
 * Class Advertising
 * @ORM\MappedSuperclass
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Domain\Repository\Advertising\AdvertisingRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *  "template" = "TemplateAd",
 *  "olx" = "OlxAdvertising" 
 * })
 */
abstract class Advertising 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * generated unique hash from offer_id and random salt
     * @var UniqueAdIdentifier
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    private $uniqueIdentifier;

    /**
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Offer\Offer", inversedBy="ads")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id", unique=false)
     */
    private $offer;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $description;
}