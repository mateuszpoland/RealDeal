<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Client\Read;

use Doctrine\Common\Collections\ArrayCollection;


class ClientDocument
{

    private $id;

    private int $clientId;

    private string $name;


    private string $secondName;


    private string $email;


    private string $stage;

    private ArrayCollection $ownedProperties;

    private ArrayCollection $prospectiveProperties;

    public function __construct()
    {
        $this->ownedProperties = new ArrayCollection();
        $this->prospectiveProperties = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getSecondName(): string
    {
        return $this->secondName;
    }

    /**
     * @param string $secondName
     */
    public function setSecondName(string $secondName): void
    {
        $this->secondName = $secondName;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
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

    public function addOwnedProperty(EmbeddedPropertyObject $offer): void
    {
        if(!$this->ownedProperties->contains($offer)) {
            $this->ownedProperties->add($offer);
        }
    }

    public function removeOwnedProperty(EmbeddedPropertyObject $offer): void
    {
        $this->ownedProperties->remove($offer);
    }

    public function addProspectiveProperty(EmbeddedPropertyObject $offer): void
    {
        if(!$this->prospectiveProperties->contains($offer)) {
            $this->prospectiveProperties->add($offer);
        }
    }

    public function removeProspectiveProperty(EmbeddedPropertyObject $offer): void
    {
        $this->prospectiveProperties->remove($offer);
    }


    public function getOwnedProperties(): ArrayCollection
    {
        return $this->ownedProperties;
    }

    public function getProspectiveProperties(): ArrayCollection
    {
        return $this->prospectiveProperties;
    }

    /**
     * @param ArrayCollection $ownedProperties
     */
    public function setOwnedProperties(ArrayCollection $ownedProperties): void
    {
        $this->ownedProperties = $ownedProperties;
    }

    /**
     * @param ArrayCollection $prospectiveProperties
     */
    public function setProspectiveProperties(ArrayCollection $prospectiveProperties): void
    {
        $this->prospectiveProperties = $prospectiveProperties;
    }
}
