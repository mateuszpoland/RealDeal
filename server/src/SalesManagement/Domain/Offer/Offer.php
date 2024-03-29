<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use RealDeal\AccountManagement\Domain\User;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyContractType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyLegalStatus;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyMarketType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\RoomsNumber;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\UniqueOfferIdentifier;

/**
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Offer\OfferRepository")
 * @ORM\Table(name="offers", indexes={@ORM\Index(name="name_idx", columns={"name"})})
 */
class Offer implements OfferState
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
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
     * @ORM\OneToOne(targetEntity="RealDeal\AccountManagement\Domain\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var PropertyType
     * @ORM\Embedded(class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyType", columnPrefix=false)
     */
    private $propertyType;

    /**
     * @var PropertyOfferingType
     * @ORM\Embedded(class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType", columnPrefix=false)
     */
    private $offeringType;

    /**
     * @var PropertyMarketType
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyMarketType", columnPrefix=false)
     */
    private $propertyMarketType;

    /**
     * @var PropertyLegalStatus
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyLegalStatus", columnPrefix=false)
     */
    private $propertyLegalStatus;

    /**
     * @var PropertyContractType
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyContractType", columnPrefix=false)
     */
    private  $propertyContractType;

    /**
     * @ORM\OneToMany(targetEntity="RealDeal\SalesManagement\Domain\Advertising\Advertising", mappedBy="offer", cascade={"persist"})
     */
    private Collection $ads;

    /**
     * @var Price
     * @ORM\Embedded(class="RealDeal\SalesManagement\Domain\Offer\ValueObject\Price", columnPrefix=false)
     */
    public $totalPrice;

    /**
     * @var Footage
     * @ORM\Column(type="float", nullable=true)
     */
    private $footage;

    private $pricePerFootage;

    /**
     * @var RoomsNumber
     * @ORM\Embedded (class="RealDeal\SalesManagement\Domain\Offer\ValueObject\RoomsNumber", columnPrefix=false)
     */
    private $numberOfRooms;

    /**
     * @var string
     * @todo - make another entity - embeddable address
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
     * @ORM\Column(type="datetime", name="available_from")
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
     * @ORM\ManyToOne(targetEntity="RealDeal\SalesManagement\Domain\Client\Client", inversedBy="ownedProperties", cascade={"persist"})
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="OfferPhoto", mappedBy="offer", cascade={"persist"})
     */
    private $offerPhotos;

    /**
     * @ORM\ManyToMany(targetEntity="RealDeal\SalesManagement\Domain\Client\Client", inversedBy="prospectiveProperties")
     * @ORM\JoinTable(name="prospective_clients",
     *     joinColumns={@ORM\JoinColumn(name="offer_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="client_id", referencedColumnName="id")})
     */
    private $prospectiveClients;

    /**
     * In what available state the offer is
     * @ORM\Column(type="string")
     */
    private $state = self::STATE_NEW;

    public function __construct()
    {
        $this->prospectiveClients = new ArrayCollection();
        $this->offerPhotos = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function publishNewOffer(
        string $name,
        User $user,
        float $totalPrice,
        float $footage,
        int $numberOfRooms,
        Client $client,
        string $contractType,
        string $legalStatus,
        string $marketType,
        string $offeringType,
        string $propertyType,
        \DateTime $availableFrom
    ): void
    {
        $this->name = $name;
        $this->identifier = UniqueOfferIdentifier::create();
        $this->user = $user;
        $this->totalPrice = new Price($totalPrice);
        $this->footage = $footage;
        $this->numberOfRooms = new RoomsNumber($numberOfRooms);
        $this->client = $client;
        $this->propertyContractType = new PropertyContractType($contractType);
        $this->propertyLegalStatus = new PropertyLegalStatus($legalStatus);
        $this->propertyMarketType = new PropertyMarketType($marketType);
        $this->offeringType = new PropertyOfferingType($offeringType);
        $this->propertyType = new PropertyType($propertyType);
        $this->offerReleaseDate = $availableFrom;

        $client->addOwnedProperty($this);
    }

    public function changePropertyOwner(Client $client): self
    {
        $this->client = $client;
        // here we should first check if this operation is permittable, consider going back to aggregate root with repositories
        return $this;
    }

    public function getPropertyOwner(): ?Client
    {
        return $this->client;
    }

    public function addProspectiveClient(Client $client): void
    {
        $client->addProspectiveProperty($this);
        $this->prospectiveClients->add($client);
        $client->addProspectiveProperty($this);
    }

    public function removeProspectiveClient(Client $client): void
    {
        if($this->prospectiveClients->contains($client)) {
            $client->removeProspectiveProperty($this);
            $this->prospectiveClients->remove($client);
            $client->removeProspectiveProperty($this);
        }
    }

    public function addPhoto(OfferPhoto $photo): void
    {
        if(!$this->offerPhotos->contains($photo)) {
            $this->offerPhotos->add($photo);
            $photo->setOffer($this);
        }
    }

    public function removePhoto(OfferPhoto $photo): void
    {
        if($this->offerPhotos->contains($photo)) {
            $this->offerPhotos->remove($photo);
        }
    }

    public function getTotalPrice(): Price
    {
        return $this->totalPrice;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getOfferingType(): PropertyOfferingType
    {
        return $this->offeringType;
    }

    public function getPropertyMarketType(): PropertyMarketType
    {
        return $this->propertyMarketType;
    }

    public function getPropertyLegalStatus(): PropertyLegalStatus
    {
        return $this->propertyLegalStatus;
    }

    public function getPropertyContractType(): PropertyContractType
    {
        return $this->propertyContractType;
    }

    public function getPropertyType(): PropertyType
    {
        return $this->propertyType;
    }
}
