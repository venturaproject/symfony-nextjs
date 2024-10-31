<?php

declare(strict_types=1);

namespace App\Products\Application\Commands\Create;

class CreateProductDTO
{
    public string $name;
    public float $price;
    public ?string $description;
    public ?\DateTimeInterface $date_add; 

    public function __construct(string $name, float $price, ?string $description = null, ?\DateTimeInterface $date_add = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->date_add = $date_add; 
    }
}
