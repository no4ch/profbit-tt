<?php

declare(strict_types=1);

namespace App\Enum\Product;

enum ProductSortableFieldEnum: string
{
    case ID = 'id';

    case CODE = 'code';

    case NAME = 'name';

    case TYPE = 'type';

    case PRICE = 'price';

    case CREATED_AT = 'createdAt';

    case UPDATED_AT = 'updatedAt';
}
