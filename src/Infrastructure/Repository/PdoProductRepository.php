<?php

namespace juliocsimoesp\PhpMySql\Infrastructure\Repository;

use DomainException;
use juliocsimoesp\PhpMySql\Domain\Model\Product;
use juliocsimoesp\PhpMySql\Domain\Repository\ProductRepository;
use juliocsimoesp\PhpMySql\Infrastructure\Traits\ProductTypeValidation;
use PDO;
use PDOStatement;

class PdoProductRepository implements ProductRepository
{
    use ProductTypeValidation;

    private PDO $pdo;

    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function allProducts(): array
    {
        $readQuery = "SELECT * FROM serenatto.produtos";
        $statement = $this->pdo->prepare($readQuery);
        $statement->execute();

        return $this->hydrateProductList($statement);
    }

    public function productsByType(string $type): array
    {
        $readQuery = "SELECT * FROM serenatto.produtos WHERE tipo = ?";
        $statement = $this->pdo->prepare($readQuery);
        $statement->bindValue(1, $type, PDO::PARAM_STR);
        $statement->execute();

        return $this->hydrateProductList($statement);
    }

    private function hydrateProductList(PDOStatement $statement): array
    {
        $queryResult = $statement->fetchAll();
        $productList = [];

        foreach ($queryResult as $product) {
            $productList[] = new Product(
                $product['id'],
                $product['tipo'],
                $product['nome'],
                $product['descricao'],
                $product['imagem'],
                $product['preco']
            );
        }

        return $productList;
    }

    public function addProduct(Product $product): bool
    {
        $this->validateProductType($product->getType());

        $insertQuery = "INSERT INTO serenatto.produtos (tipo, nome, descricao, imagem, preco) VALUES (:tipo, :nome, :descricao, :imagem, :preco);";
        $statement = $this->pdo->prepare($insertQuery);
        $statement->bindValue(':tipo', $product->getType(), PDO::PARAM_STR);
        $statement->bindValue(':nome', $product->getName(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $product->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':imagem', $product->getImage(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $product->getPrice(), PDO::PARAM_STR);
        $result = $statement->execute();

        $product->setId($this->pdo->lastInsertId());

        return $result;
    }

    public function updateProduct(Product $product): bool
    {
        $this->validateProductType($product->getType());

        $updateQuery = "UPDATE serenatto.produtos SET tipo = :tipo, nome = :nome, descricao = :descricao, imagem = :imagem, preco = :preco WHERE id = :id;";
        $statement = $this->pdo->prepare($updateQuery);
        $statement->bindValue(':tipo', $product->getType(), PDO::PARAM_STR);
        $statement->bindValue(':nome', $product->getName(), PDO::PARAM_STR);
        $statement->bindValue(':descricao', $product->getDescription(), PDO::PARAM_STR);
        $statement->bindValue(':imagem', $product->getImage(), PDO::PARAM_STR);
        $statement->bindValue(':preco', $product->getPrice(), PDO::PARAM_STR);
        $statement->bindValue(':id', $product->getId(), PDO::PARAM_INT);

        return $statement->execute();
    }

    public function removeProduct(Product $product): bool
    {
        $removeQuery = "DELETE FROM serenatto.produtos WHERE id = :id;";
        $statement = $this->pdo->prepare($removeQuery);
        $statement->bindValue(':id', $product->getId(), PDO::PARAM_INT);

        return $statement->execute();
    }
}
