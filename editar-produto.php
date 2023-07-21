<?php
require_once 'vendor/autoload.php';

use juliocsimoesp\PhpMySql\Domain\Model\Product;
use juliocsimoesp\PhpMySql\Infrastructure\Persistence\MySqlConnectionCreator;
use juliocsimoesp\PhpMySql\Infrastructure\Repository\PdoProductRepository;

$pdo = MySqlConnectionCreator::CreateConnection();
$repository = new PdoProductRepository($pdo);

if (isset($_GET['id'])) {
    $product = $repository->productsById($_GET['id']);
}

if (isset($_POST['editar'])) {
    $updatedProduct = new Product(
        $_POST['id'],
        $_POST['tipo'],
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['preco'],
        $_POST['imagemNome'],
    );

    if (file_exists($_FILES['imagem']['tmp_name'])) {
        $updatedProduct->setImage(uniqid() . $_FILES['imagem']['name']);
        move_uploaded_file($_FILES['imagem']['tmp_name'], $updatedProduct->getFormattedImage());
    }

    $repository->updateProduct($updatedProduct);

    adminRedirection();
}
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <title>Serenatto - Editar Produto</title>
</head>
<body>
<main>
    <section class="container-admin-banner">
        <img src="img/logo-serenatto-horizontal.png" class="logo-admin" alt="logo-serenatto">
        <h1>Editar Produto</h1>
        <img class="ornaments" src="img/ornaments-coffee.png" alt="ornaments">
    </section>
    <section class="container-form">
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product->getId() ?>">

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Digite o nome do produto"
                   value="<?= $product->getName() ?>" required>

            <div class="container-radio">
                <div>
                    <label for="cafe">Café</label>
                    <input type="radio" id="cafe" name="tipo" value="Café" <?php if ($product->getType() == 'Café') {
                        echo 'checked';
                    } ?>>
                </div>
                <div>
                    <label for="almoco">Almoço</label>
                    <input type="radio" id="almoco" name="tipo" value="Almoço" <?php if ($product->getType() == 'Almoço') {
                        echo 'checked';
                    } ?>>
                </div>
            </div>

            <label for="descricao">Descrição</label>
            <input type="t" id="descricao" name="descricao" placeholder="Digite uma descrição"
                   value="<?= $product->getDescription() ?>" required>

            <label for="preco">Preço</label>
            <input type="text" id="preco" name="preco" placeholder="Digite uma descrição"
                   value="<?= number_format($product->getPrice(), 2) ?>" required>

            <label for="imagem">Envie uma imagem do produto</label>
            <input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">
            <input type="hidden" name="imagemNome" value="<?= $product->getImage() ?>">

            <input type="submit" name="editar" class="botao-cadastrar" value="Editar produto"/>
        </form>

    </section>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"
        integrity="sha512-Rdk63VC+1UYzGSgd3u2iadi0joUrcwX0IWp2rTh6KXFoAmgOjRS99Vynz1lJPT8dLjvo6JZOqpAHJyfCEZ5KoA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/index.js"></script>
</body>
</html>