<?php
declare(strict_types=1);

namespace RealDeal\AccountManagement\Domain;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
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
     * @ORM\Column(type="string", length=25, unique=true)
     */
    private string $username;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Unique()
     */
    private string $email;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isActive;

    /**
     * @ORM\Column(type="array")
     */
    private array $roles;

    private function __construct()
    {
    }

    public static function createNew(
        string $firstName,
        string $lastName,
        string $userName,
        string $email,
        string $password
    ): self
    {
        $user = new self();
        $user->username = $userName;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->password = $password;
        $user->email = $email;
        $user->isActive = true;
        $user->roles = ['ROLE_USER'];

        return $user;
    }

    public function asAdmin(User $user): User
    {
        $user->roles = array_merge($user->getRoles(), ['ROLE_ADMIN']);

        return $user;
    }

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

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSalt()
    {
    }

    public function getUsername(): string
    {
       return $this->username;
    }

    public function eraseCredentials(): void
    {
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }
}
