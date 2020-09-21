<?php
declare(strict_types=1);

namespace RealDeal\SalesManagement\Application\Command\Client;


use Doctrine\Common\Collections\ArrayCollection;
use RealDeal\Shared\Application\CommandInterface;

class CreateClientCommand implements CommandInterface
{
    private string $name;

    private string $secondName;

    private string $email;

    private string $stage;

    private ArrayCollection $ownedProperties;

    public function __construct(
        string $name,
        string $secondName,
        string $email,
        string $stage
    )
    {
        $this->name = $name;
        $this->secondName = $secondName;
        $this->email = $email;
        $this->stage = $stage;
        $this->ownedProperties = new ArrayCollection();
    }

    public function setOwnedProperties(ArrayCollection $ownedProperties): void
    {
        $this->ownedProperties = $ownedProperties;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStage(): string
    {
        return $this->stage;
    }

    public function getOwnedProperties(): ArrayCollection
    {
        return $this->ownedProperties;
    }

    public function __toString(): string
    {
        return get_class($this);
    }

}