<?php

declare(strict_types=1);

namespace App\Users\Application\Queries\GetUser;

class GetUserDTO
{
    public int $id;
    public string $email;
    public string $name;
    public string $created_at; 
    public string $updated_at; 

    public function __construct(int $id, string $email, string $name, \DateTimeInterface $createdAt, \DateTimeInterface $updatedAt)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->created_at = $createdAt->format('Y-m-d H:i:s'); 
        $this->updated_at = $updatedAt->format('Y-m-d H:i:s'); 
    }

    /**
     * @return array<string, int|string>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at,
        ];
    }
}
