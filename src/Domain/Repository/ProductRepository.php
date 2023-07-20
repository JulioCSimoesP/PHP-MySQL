<?php

namespace juliocsimoesp\PhpMySql\Domain\Repository;

use juliocsimoesp\PhpMySql\Domain\Model\Product;

interface ProductRepository
{
    public function allProducts(): array;

    public function productsByType(string $type): array;

    public function addProduct(Product $product): bool;

    public function updateProduct(Product $product): bool;

    public function removeProduct(Product $product): bool;
}
