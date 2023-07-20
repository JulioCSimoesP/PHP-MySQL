<?php

namespace juliocsimoesp\PhpMySql\Infrastructure\Traits;

use DomainException;

trait ProductTypeValidation
{
    /**
     * @var string[] $typeControl
     */
    private array $typeControl = [
        'Café',
        'Almoço'
    ];

    private function validateProductType(string $string): void
    {
        if (!in_array($string, $this->typeControl)) {
            throw new DomainException('Tipo de produto inválido');
        }
    }
}