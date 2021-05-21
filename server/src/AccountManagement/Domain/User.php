<?php
declare(strict_types=1);

namespace RealDeal\AccountManagement\Domain;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="RealDeal\AccountManagement\Domain\Repository\UserRepository")
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{
    public const ROLE_USER = 'user';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", unique=false)
     */
    private string $lastName;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="json")
     */
    private string $roles;

    /**
     * @return mixed
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user has at least user role
        $roles[] = self::ROLE_USER;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getPassword(): string
    {

    }

    public function getSalt()
    {
    }

    public function getUsername(): string
    {
       return (string) $this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
