<?php

namespace App\Repository;

use App\Entity\Product;
use App\Enum\Product\ProductTypeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function create(
        string $code,
        string $name,
        ProductTypeEnum $type,
        float $price
    ): Product {
        return new Product(
            $code,
            $name,
            $type,
            $price,
        );
    }

    /**
     * @param Product[] $products
     * @return void
     */
    public function saveMultiple(
        array $products
    ) {
        $entityManager = $this->getEntityManager();

        foreach ($products as $product) {
            $entityManager->persist($product);
        }

        $entityManager->flush();
    }
}
