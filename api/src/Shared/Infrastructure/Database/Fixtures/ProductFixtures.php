<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Fixtures;

use App\Products\Domain\Entity\Product;
use Carbon\Carbon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ProductFixtures extends Fixture
{
    private string $dataPath = __DIR__ . '/../data/products.json';

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();

        $jsonData = file_get_contents($this->dataPath);
        $productData = $jsonData ? json_decode($jsonData, true) : [];

        foreach ($productData as $data) {
            // Crear el producto pasando los parámetros en el orden correcto
            $product = new Product(
                $data['name'],                  // Nombre
                $faker->randomFloat(2, 10, 1000), // Precio
                $data['description'] ?? null      // Descripción
            );

            $product->setDateAdd(Carbon::now());

            $manager->persist($product);
        }

        $manager->flush();
    }
}

