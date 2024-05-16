<?php

namespace App\Entity;

use App\Enum\Product\ProductTypeEnum;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::BIGINT, options: ['unsigned' => true])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $code;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(length: 255)]
    private string $type;

    #[ORM\Column]
    private float $price;

    /**
     * @param string $code
     * @param string $name
     * @param ProductTypeEnum $type
     * @param float $price
     */
    public function __construct(
        string $code,
        string $name,
        ProductTypeEnum $type,
        float $price
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->type = $type->value;
        $this->price = $price;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getType(): ProductTypeEnum
    {
        return ProductTypeEnum::from($this->type);
    }

    public function setType(ProductTypeEnum $type): void
    {
        $this->type = $type->value;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
