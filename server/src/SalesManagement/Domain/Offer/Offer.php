<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer;

use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Advertising\Advertising;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;
use ONGR\ElasticsearchDSL\Query\Compound\FunctionScoreQuery;
use RealDeal\Shared\Domain\AggreagateRoot;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Class Offer
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Domain\Repository\Offer\OfferRepository")
 * @ORM\Table(name="offers", indexes={@ORM\Index(name="name_idx", columns={"name"})})
 */
class Offer extends AggreagateRoot implements OfferState
{
    /**
     * change strategy generator to CUSTOM
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var UniqueOfferIdentifier
     * @ORM\Column(type="string", unique=true)
     */
    private $identifier;

    /**
     * @var string
     * @ORM\Column(type="string", length=280)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="RealDeal\SalesManagement\Domain\Advertising\Advertising", mappedBy="offer", cascade={"persist"})
     */
    private $ads;

    /**
     * @var Price
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPrice;

    /**
     * @var Footage
     * @ORM\Column(type="float", nullable=true)
     */
    private $footage;

    /**
     * @var Price
     */
    private $pricePerFootage;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfRooms;

    /**
     * @var string
     * @todo - make another entity
     * @ORM\Column(type="string", nullable=true)
     */
    private $district;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $buildingNumber;

    /**
     * @var string 
     * @ORM\Column(type="integer", nullable=true)
     */
    private $flatNumber;

    /**
     * @var int 
     */
    private $floorNumber;

    /**
     * @var int 
     */
    private $floorsInBuilding;

    /**
     * When property/builing was built.
     *
     * @var string
     */
    private $buildingYear;

    /**    
     * @var BuildingType
     */
    private $buildingType;

    /**
     * Building book number
     * @var KWWType
     */
    private $KWNumber;

    /**
     * When Seller is able to release property
     * (e.g. "immediately", "2021-06-15", "not agreed", etc.)
     *  
     * @var DateTime
     */
    private $offerReleaseDate;

    /**
     * eg. shared, single-owner, marriage etc.
     *
     * @var [type]
     */
    private $ownershipType;

    /**
     * reference to the Seller - may be 
     * current client or new one.
     * 
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Client\Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * In what available state the offer is 
     * @var [type]
     * @ORM\Column(type="string")
     */
    private $state = self::STATE_NEW;

    // @todo - consider adding dynamic, persisted list of interested buyers - or generate them dynamically and store in different scope/table

    public function __construct()
    { 
        parent::__construct();
    }

    public function publishNewOffer(
        string $name,
        float $totalPrice,
        float $footage
    )
    {
        $this->name = $name;
        $this->totalPrice = $totalPrice;
        $this->footage = $footage;
    }

    public function createAdForOffer()
    {

    }

    public function changeOfferName(string $name): void
    {

    }

    public function changeTotalPrice(): void
    {

    }
}