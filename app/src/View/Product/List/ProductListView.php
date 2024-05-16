<?php

declare(strict_types=1);

namespace App\View\Product\List;

use App\Entity\Product;
use App\Enum\Product\ProductSortableDirectionEnum;
use App\Enum\Product\ProductSortableFieldEnum;

class ProductListView
{
    public const PRODUCTS_PER_PAGE = 20;

    private readonly int $page;

    private readonly ProductListViewProducer $producer;

    private readonly ProductSortableFieldEnum $productSortableField;

    private readonly ProductSortableDirectionEnum $productSortableDirection;

    /** @var Product[] */
    private readonly array $products;

    private readonly int $productsCount;

    public function __construct(
        int $page,
        ProductListViewProducer $producer,
        ProductSortableFieldEnum $productSortableField,
        ProductSortableDirectionEnum $productSortableDirection
    ) {
        $this->page = $page;
        $this->producer = $producer;
        $this->productSortableField = $productSortableField;
        $this->productSortableDirection = $productSortableDirection;
    }

    public function getPreviousPageNumber(): int
    {
        return ($this->page > 1)
            ? $this->page - 1
            : $this->page;
    }

    public function getNextPageNumber(): int
    {
        return ($this->isLastPage())
            ? $this->page
            : $this->page + 1;
    }

    public function isFirstPage(): bool
    {
        return $this->page === 1;
    }

    public function isLastPage(): bool
    {
        return ($this->page * self::PRODUCTS_PER_PAGE) >= $this->getProductsCount();
    }

    /**
     * @return int
     */
    public function getProductsCount(): int
    {
        if (!isset($this->productsCount)) {
            $this->productsCount = $this->producer->getProductsCount();
        }

        return $this->productsCount;
    }

    /**
     * @return Product[]
     */
    public function getProducts(): array
    {
        if (!isset($this->products)) {
            $from = ($this->page - 1) * self::PRODUCTS_PER_PAGE;

            $this->products = $this->producer->getProducts(
                $from,
                self::PRODUCTS_PER_PAGE,
                $this->productSortableField,
                $this->productSortableDirection
            );
        }

        return $this->products;
    }

    public function getCurrentDirection(): string
    {
        return $this->productSortableDirection->value;
    }

    public function getAskDirection(): string
    {
        return ProductSortableDirectionEnum::ASC->value;
    }

    public function getDescDirection(): string
    {
        return ProductSortableDirectionEnum::DESC->value;
    }

    public function getCurrentFieldName(): string
    {
        return $this->productSortableField->value;
    }

    public function getIdFieldName(): string
    {
        return ProductSortableFieldEnum::ID->value;
    }

    public function getCodeFieldName(): string
    {
        return ProductSortableFieldEnum::CODE->value;
    }

    public function getNameFieldName(): string
    {
        return ProductSortableFieldEnum::NAME->value;
    }

    public function getTypeFieldName(): string
    {
        return ProductSortableFieldEnum::TYPE->value;
    }

    public function getPriceFieldName(): string
    {
        return ProductSortableFieldEnum::PRICE->value;
    }

    public function getCreatedAtFieldName(): string
    {
        return ProductSortableFieldEnum::CREATED_AT->value;
    }

    public function getUpdatedAtFieldName(): string
    {
        return ProductSortableFieldEnum::UPDATED_AT->value;
    }

    public function test(): array
    {
        return [
            'ssss' => 1
        ];
    }
}
