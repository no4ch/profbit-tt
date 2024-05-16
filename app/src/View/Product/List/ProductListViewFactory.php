<?php

declare(strict_types=1);

namespace App\View\Product\List;

use App\Enum\Product\ProductSortableDirectionEnum;
use App\Enum\Product\ProductSortableFieldEnum;

class ProductListViewFactory
{
    private ProductListViewProducer $producer;

    public function __construct(
        ProductListViewProducer $producer
    ) {
        $this->producer = $producer;
    }

    public function create(
        int $page,
        ProductSortableFieldEnum $productSortableField,
        ProductSortableDirectionEnum $productSortableDirection
    ): ProductListView {
        return new ProductListView(
            $page,
            $this->producer,
            $productSortableField,
            $productSortableDirection
        );
    }
}
