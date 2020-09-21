<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Domain\Client\Read;

use Doctrine\Common\Collections\ArrayCollection;
use ONGR\ElasticsearchBundle\Annotation as ES;

/**
 * @ES\Index(alias="clients")
 */
class ClientDocument
{
    /**
     * @ES\Id()
     */
    private string $id;

    /**
     * @ES\Property(type="text", name="name")
     */
    private string $name;

    /**
     * @ES\Property(type="text", name="name")
     */
    private string $secondName;

    /**
     * @ES\Property(type="text", name="name")
     */
    private string $email;

    /**
     * @ES\Property(type="text", name="name")
     */
    private string $stage;

    /**
     * @ES\Embedded(class="RealDeal\SalesManagement\Domain\Client\Read\EmbeddedPropertyObject")
     */
    private ArrayCollection $ownedProperties;

    /**
     * @ES\Embedded(class="RealDeal\SalesManagement\Domain\Client\Read\EmbeddedPropertyObject")
     */
    private ArrayCollection $prospectiveProperties;

    public function __construct()
    {
        $this->ownedProperties = new ArrayCollection();
        $this->prospectiveProperties = new ArrayCollection();
    }

    public function getId(): string
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