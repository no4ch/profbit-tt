<?php

namespace App\DataFixtures;

use App\Enum\Product\ProductTypeEnum;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    private const PRODUCT_FIXTURES_COUNT = 100;

    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $products = [];
        for ($i = 0; $i < self::PRODUCT_FIXTURES_COUNT; $i++) {
            $code = (string) random_int(1, 10);
            $name = $faker->name();
            $type = $faker->randomElement(ProductTypeEnum::cases());
            $price = $faker->randomFloat(2, 100, 1000);

            $products[] = $this->productRepository->create(
                $code,
                $name,
                $type,
                $price
            );
        }

        $this->productRepository->saveMultiple($products);
    }
}
