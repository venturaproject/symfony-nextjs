<?php

declare(strict_types=1);

namespace App\Products\Domain\Entity;

class Product
{
    private int $id;
    private ?string $name = null;
    private ?string $description = null;
    private ?float $price = null;
    private ?\DateTimeInterface $date_add = null; 
    private ?\DateTimeInterface $created_at = null; 
    private ?\DateTimeInterface $updated_at = null; 

    public function __construct(string $name, float $price, ?string $description = null)
    {

        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->date_add = new \DateTime(); 
        $this->created_at = new \DateTime(); 
        $this->updated_at = new \DateTime(); 
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;
        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->date_add;
    }

    public function setDateAdd(\DateTimeInterface $date_add): static
    {
        $this->date_add = $date_add;
        return $this;
    }

    public function getCreatedAdd(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAdd(\DateTimeInterface $created_at): static 
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdatedAdd(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAdd(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;
        return $this;
    }
}
