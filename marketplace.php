<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

$query = "
    SELECT p.*, c.nome AS categoria_nome, u.nome AS usuario_nome
    FROM produtos p
    JOIN categorias c ON p.categoria_id = c.id
    JOIN usuarios u ON p.usuario_id = u.id
    ORDER BY p.criado_em DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">

<h1>Marketplace</h1>
<a href="cadastro_produto.php" class="btn btn-success mb-4">+ Novo Produto</a>

<div class="row row-cols-1 row-cols-md-3 g-4">
<?php while ($produto = $result->fetch_assoc()) { ?>
    <div class="col">
        <div class="card h-100">
            <?php if ($produto['imagem'] && file_exists($produto['imagem'])) { ?>
                <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top" alt="Imagem do produto">
            <?php } else { ?>
                <img src="https://via.placeholder.com/300x200?text=Sem+Imagem" class="card-img-top" alt="Sem imagem">
            <?php } ?>
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($produto['titulo']) ?></h5>
                <p class="card-text"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
            </div>
            <div class="card-footer">
                <small class="text-muted">Preço: R$ <?= number_format($produto['preco'], 2, ',', '.') ?></small><br>
                <small class="text-muted">Categoria: <?= htmlspecialchars($produto['categoria_nome']) ?></small><br>
                <small class="text-muted">Vendedor: <?= htmlspecialchars($produto['usuario_nome']) ?></small><br>
                <small class="text-muted">Publicado em: <?= date('d/m/Y H:i', strtotime($produto['criado_em'])) ?></small>
            </div>
        </div>
    </div>
<?php } ?>
</div>

</body>
</html>
