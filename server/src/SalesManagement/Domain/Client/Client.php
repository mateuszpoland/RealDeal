<?php

namespace RealDeal\SalesManagement\Domain\Client;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use RealDeal\SalesManagement\Domain\Offer\Offer as Offer;

/**
 * Class Client
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="RealDeal\SalesManagement\Application\Repository\Client\ClientRepository")
 */
class Client
{
    //use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string")
     */
    private string $secondName;

    /**
     * @ORM\Column(type="string")
     */
    private string $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $stage;

    /**
     * @ORM\OneToMany(targetEntity="RealDeal\SalesManagement\Domain\Offer\Offer", mappedBy="client", cascade={})
     */
    private Collection $ownedProperties;

    /**
     * @ORM\ManyToMany(targetEntity="RealDeal\SalesManagement\Domain\Offer\Offer", mappedBy="prospectiveClients")
     */
    private Collection $prospectiveProperties;

    /**
     * @ORM\OneToMany(targetEntity="RealDeal\SalesManagement\Domain\Filter\Offer\Category\OfferSearch", mappedBy="client")
     */
    private Collection $propertySearchFilters;

    public function __construct()
    {
        $this->ownedProperties = new ArrayCollection();
        $this->prospectiveProperties = new ArrayCollection();
        $this->propertySearchFilters = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function addOwnedProperty(Offer $offer): self
    {
        $this->ownedProperties->add($offer);
        $offer->changePropertyOwner($this);

        return $this;
    }

    public function removeOwnedProperty(Offer $offer): void
    {
        if($this->ownedProperties->contains($offer)) {
            $this->ownedProperties->remove($offer);
            //consider going back to aggregate root
            // offer should remove its owner and propagate event
            // at least dispatch some event in event handler to remove propoerty owner or mark it as vacant, flag it some way and display other way on front to
            // force user to assign it an owner
        }
    }

    public function addProspectiveProperty(Offer $offer): void
    {
        if($this->ownedProperties->contains($offer)) {
            throw new \InvalidArgumentException('Cannot add offer ' . $offer->getId() . ' client is its owner.');
        }
        if(!$this->prospectiveProperties->contains($offer)) {
            $this->prospectiveProperties->add($offer);
            $offer->addProspectiveClient($this);
        }
    }

    public function removeProspectiveProperty(Offer $offer): void
    {
        if($this->prospectiveProperties->contains($offer)) {
            $this->prospectiveProperties->remove($offer);
            $offer->removeProspectiveClient($this);
        }
    }

    public function setOwnedProperties(Collection $ownedProperties): void
    {
        $this->ownedProperties = $ownedProperties;
    }

    public function setProspectiveProperties(Collection $prospectiveProperties): void
    {
        foreach ($prospectiveProperties as $prospectiveProperty) {
            if($prospectiveProperties instanceof Offer) {
                $prospectiveProperty->addProspectiveClient($this);
            }
        }
        $this->prospectiveProperties = $prospectiveProperties;
    }

    public function getOwnedProperties(): Collection
    {
        return $this->ownedProperties;
    }

    public function getProspectiveProperties(): Collection
    {
        return $this->prospectiveProperties;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function setStage(string $stage): void
    {
        $this->stage = $stage;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }
}
