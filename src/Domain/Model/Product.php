<?php

namespace juliocsimoesp\PhpMySql\Domain\Model;

use DomainException;
use juliocsimoesp\PhpMySql\Infrastructure\Traits\ProductTypeValidation;

class Product
{
    use ProductTypeValidation;

    private ?int $id;

    private string $type;

    private string $name;

    private string $description;

    private string $image;

    private float $price;

    /**
     * @param int|null $id
     * @param string $type
     * @param string $name
     * @param string $description
     * @param string $image
     * @param float $price
     */
    public function __construct(?int $id, string $type, string $name, string $description, string $image, float $price)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(int $id): void
    {
        if (!is_null($this->id)) {
            throw new DomainException('ID não pode ser definido mais de uma vez');
        }

        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->validateProductType($type);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getFormattedPrice(): string
    {
        return 'R$ ' . number_format($this->price, 2);
    }

    /**
     * @return string
     */
    public function getFormattedImage(): string
    {
        return './img/' . $this->image;
    }
}
