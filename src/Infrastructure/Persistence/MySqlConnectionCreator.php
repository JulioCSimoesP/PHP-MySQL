<?php

namespace juliocsimoesp\PhpMySql\Infrastructure\Persistence;

use PDO;

class MySqlConnectionCreator
{
    public function CreateConnection(): PDO
    {
        $pdo = new PDO('mysql:dbname=serenatto;host=localhost', 'root', 'senha');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $pdo;
    }
}