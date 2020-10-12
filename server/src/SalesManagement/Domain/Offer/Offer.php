<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Offer;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use RealDeal\SalesManagement\Domain\Client\Client;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\Price;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyContractType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyLegalStatus;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyMarketType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\PropertyOfferingType;
use RealDeal\SalesManagement\Domain\Offer\ValueObject\UniqueOfferIdentifier;

/**
 * Class Offer
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
     * @var PropertyOfferingType
     * @ORM\Column(type="string", length=200)
     */
    private $offeringType;

    /**
     * @var PropertyMarketType
     * @ORM\Column(type="string", length=200)
     */
    private $propertyMarketType;

    /**
     * @var PropertyLegalStatus
     * @ORM\Column(type="string", length=200)
     */
    private $propertyLegalStatus;

    /**
     * @var PropertyContractType
     * @ORM\Column(type="string", length=200)
     */
    private  $propertyContractType;

    /**
     * @ORM\OneToMany(targetEntity="RealDeal\SalesManagement\Domain\Advertising\Advertising", mappedBy="offer", cascade={"persist"})
     */
    private Collection $ads;

    /**
     * @var Price
     * @ORM\Column(type="string", nullable=true)
     */
    public $totalPrice;

    /**
     * @var Footage
     * @ORM\Column(type="float", nullable=true)
     */
    private $footage;

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
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function publishNewOffer(
        string $name,
        float $totalPrice,
        float $footage,
        Client $client,
        string $contractType,
        string $legalStatus,
        string $marketType,
        string $offeringType,
        \DateTime $availableFrom
    ): void
    {
        $this->name = $name;
        $this->identifier = new UniqueOfferIdentifier();
        $this->totalPrice = new Price($totalPrice);
        $this->footage = $footage;
        $this->client = $client;
        $this->propertyContractType = new PropertyContractType($contractType);
        $this->propertyLegalStatus = new PropertyLegalStatus($legalStatus);
        $this->propertyMarketType = new PropertyMarketType($marketType);
        $this->offeringType = new PropertyOfferingType($offeringType);
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

    public function getIdentifier(): UniqueOfferIdentifier
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
}
