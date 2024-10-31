<?php

declare(strict_types=1);

namespace App\Users\Application\Commands\Update;

class UpdateUserDTO
{
    public ?string $name;
    public ?string $email;
    public ?string $password; 
    public ?\DateTimeInterface $emailVerifiedAt; 
    public ?\DateTimeInterface $updatedAt;

    public function __construct(?string $name, ?string $email, ?string $password, ?\DateTimeInterface $emailVerifiedAt = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->emailVerifiedAt = $emailVerifiedAt;
        $this->updatedAt = new \DateTime(); 
    }
}
