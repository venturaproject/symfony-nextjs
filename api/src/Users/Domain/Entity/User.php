<?php

declare(strict_types=1);



namespace App\Users\Domain\Entity;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * This class represents a user in the system.
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    private int $id; 
    private string $name; 
    private string $email; 
    private string $password; 
    private ?\DateTimeInterface $emailVerifiedAt = null; 
    private ?string $rememberToken = null; 
    private ?\DateTimeInterface $created_at = null; 
    private ?\DateTimeInterface $updated_at = null; 

    /**
     * User constructor.
     *
     * @param string $name Nombre del usuario
     * @param string $email Correo electrónico del usuario
     * @param string $hashedPassword Contraseña hasheada del usuario
     */
    public function __construct(string $name, string $email, string $hashedPassword)
    {
        $this->id = 0; // Asignar ID al momento de la creación
        $this->name = $name;
        $this->email = $email;
        $this->password = $hashedPassword;
        $this->created_at = new \DateTime(); 
        $this->updated_at = new \DateTime(); 
    }

    // Métodos getter
    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEmailVerifiedAt(): ?\DateTimeInterface
    {
        return $this->emailVerifiedAt;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
        // Aquí puedes limpiar cualquier dato sensible si es necesario.
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    // Métodos setter
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->updated_at = new \DateTime(); 
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
        $this->updated_at = new \DateTime(); 
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
        $this->updated_at = new \DateTime(); 
    }

    public function setEmailVerifiedAt(?\DateTimeInterface $date): void
    {
        $this->emailVerifiedAt = $date;
        $this->updated_at = new \DateTime(); 
    }

    public function setRememberToken(?string $token): void
    {
        $this->rememberToken = $token;
        $this->updated_at = new \DateTime(); 
    }
}
