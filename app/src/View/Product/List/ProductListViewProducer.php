<?php

declare(strict_types=1);

namespace App\View\Product\List;

use App\Entity\Product;
use App\Enum\Product\ProductSortableDirectionEnum;
use App\Enum\Product\ProductSortableFieldEnum;
use App\Repository\ProductRepository;

class ProductListViewProducer
{
    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function getProductsCount(): int
    {
        return $this->productRepository->getProductsCount();
    }

    /**
     * @param int $from
     * @param int $count
     * @param ProductSortableFieldEnum $productSortableField
     * @param ProductSortableDirectionEnum $productSortableDirection
     * @return Product[]
     */
    public function getProducts(
        int $from,
        int $count,
        ProductSortableFieldEnum $productSortableField,
        ProductSortableDirectionEnum $productSortableDirection
    ): array {
        return $this->productRepository->getProducts(
            $from,
            $count,
            $productSortableField->value,
            $productSortableDirection->value
        );
    }
}
