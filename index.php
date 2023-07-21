<?php
require_once 'vendor/autoload.php';

use juliocsimoesp\PhpMySql\Domain\Model\Product;
use juliocsimoesp\PhpMySql\Infrastructure\Persistence\MySqlConnectionCreator;
use juliocsimoesp\PhpMySql\Infrastructure\Repository\PdoProductRepository;

$pdo = MySqlConnectionCreator::CreateConnection();
$productRepository = new PdoProductRepository($pdo);

/**
 * @var Product[] $listaCafes
 * @var Product[] $listaAlmocos
 */
$listaCafes = $productRepository->productsByType('Café');
$listaAlmocos = $productRepository->productsByType('Almoço');
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Cardápio</title>
</head>
<body>
<main>

    <!-- Banner principal -->
    <section class="container-banner">
        <div class="container-texto-banner">
            <img src="img/logo-serenatto.png" class="logo" alt="logo-serenatto">
        </div>
    </section>

    <!-- Cards de café -->
    <h2>Cardápio Digital</h2>
    <section class="container-cafe-manha">
        <div class="container-cafe-manha-titulo">
            <h3>Opções para o Café</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-cafe-manha-produtos">
            <?php foreach ($listaCafes as $cafe) { ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $cafe->getFormattedImage() ?>" alt="<?= $cafe->getName() ?>">
                    </div>
                    <p><?= $cafe->getName() ?></p>
                    <p><?= $cafe->getDescription() ?></p>
                    <p><?= $cafe->getFormattedPrice() ?></p>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Cards de almoço -->
    <section class="container-almoco">
        <div class="container-almoco-titulo">
            <h3>Opções para o Almoço</h3>
            <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
        </div>
        <div class="container-almoco-produtos">
            <?php foreach ($listaAlmocos as $almoco) { ?>
                <div class="container-produto">
                    <div class="container-foto">
                        <img src="<?= $almoco->getFormattedImage() ?>" alt="<?= $almoco->getName() ?>">
                    </div>
                    <p><?= $almoco->getName() ?></p>
                    <p><?= $almoco->getDescription() ?></p>
                    <p><?= $almoco->getFormattedPrice() ?></p>
                </div>
            <?php } ?>
        </div>
    </section>
</main>
</body>
</html>
