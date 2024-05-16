<?php

declare(strict_types=1);

namespace App\Enum\Product;

enum ProductSortableDirectionEnum: string
{
    case ASC = 'ASC';

    case DESC = 'DESC';
}
