<?php
require_once 'vendor/autoload.php';

use juliocsimoesp\PhpMySql\Infrastructure\Persistence\MySqlConnectionCreator;
use juliocsimoesp\PhpMySql\Infrastructure\Repository\PdoProductRepository;

$pdo = MySqlConnectionCreator::CreateConnection();
$repository = new PdoProductRepository($pdo);
$repository->removeProduct($_POST['id']);

adminRedirection();
