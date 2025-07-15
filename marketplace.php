<?php
include 'Classes/config.marketplace.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Marketplace - Hive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/marketplace.css">
    <style>
        .truncate-text {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease-in-out;
        }
    </style>
</head>

<body class="bg-light">

<div class="container-fluid py-4">
    <div class="row">

        <!-- Sidebar de categorias -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-none d-md-block bg-white rounded shadow-sm p-3 me-3">
            <h5 class="mb-3">Categorias</h5>
            <ul class="list-group">
                <a href="marketplace.php" class="list-group-item <?= !$categoria_filtro ? 'active' : '' ?>">Todas</a>
                <?php while ($cat = $categorias_result->fetch_assoc()): ?>
                    <a href="marketplace.php?categoria=<?= $cat['id'] ?>" class="list-group-item <?= $categoria_filtro == $cat['id'] ? 'active' : '' ?>">
                        <?= htmlspecialchars($cat['nome']) ?>
                    </a>
                <?php endwhile; ?>
            </ul>
        </nav>

        <!-- Conteúdo principal -->
        <main class="col-md-9 col-lg-9">
            <h1 class="mb-4">Marketplace</h1>

            <!-- Botão Criar Produto -->
            <div class="mb-4 d-flex justify-content-end">
                <a href="cadastro_produto.php" class="btn btn-success">+ Criar Produto</a>
            </div>

            <!-- Formulário de busca -->
            <form method="GET" class="mb-4 d-flex" role="search" aria-label="Busca no marketplace">
                <input type="text" name="busca" class="form-control me-2" placeholder="Buscar produtos ou categorias..." value="<?= htmlspecialchars($busca) ?>" />
                <?php if ($categoria_filtro): ?>
                    <input type="hidden" name="categoria" value="<?= htmlspecialchars($categoria_filtro) ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">Buscar</button>
                <?php if ($busca || $categoria_filtro): ?>
                    <a href="marketplace.php" class="btn btn-outline-secondary ms-2">Limpar</a>
                <?php endif; ?>
            </form>

            <!-- Grid dos produtos -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <?php if ($result->num_rows === 0): ?>
                    <p class="text-muted">Nenhum produto encontrado.</p>
                <?php else: ?>
                    <?php while ($produto = $result->fetch_assoc()): 
                        $modalId = "modalProduto" . $produto['id'];
                    ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>">
                                <?php if ($produto['imagem'] && file_exists($produto['imagem'])): ?>
                                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="card-img-top" alt="Imagem do produto" style="height:180px; object-fit:cover;">
                                <?php else: ?>
                                    <img src="https://via.placeholder.com/300x180?text=Sem+Imagem" class="card-img-top" alt="Sem imagem" style="height:180px; object-fit:cover;">
                                <?php endif; ?>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title"><?= htmlspecialchars($produto['titulo']) ?></h5>
                                    <p class="card-text truncate-text"><?= nl2br(htmlspecialchars(substr($produto['descricao'], 0, 80))) ?>...</p>
                                    <div class="mt-auto">
                                        <p class="mb-1 fw-semibold text-success">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                                        <p class="mb-0 text-muted small"><?= htmlspecialchars($produto['categoria_nome']) ?></p>
                                        <p class="mb-0 text-muted small">Vendedor: <?= htmlspecialchars($produto['usuario_nome']) ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Expandido -->
                        <div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?= htmlspecialchars($produto['titulo']) ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <?php if ($produto['imagem'] && file_exists($produto['imagem'])): ?>
                                                    <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="img-fluid rounded mb-3" alt="Imagem do produto">
                                                <?php else: ?>
                                                    <img src="https://via.placeholder.com/300x300?text=Sem+Imagem" class="img-fluid rounded mb-3" alt="Sem imagem">
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-7">
                                                <p><strong>Descrição:</strong><br><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
                                                <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                                                <p><strong>Categoria:</strong> <?= htmlspecialchars($produto['categoria_nome']) ?></p>
                                                <p><strong>Vendedor:</strong> <?= htmlspecialchars($produto['usuario_nome']) ?></p>
                                                <p><strong>Publicado em:</strong> <?= date('d/m/Y', strtotime($produto['criado_em'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-outline-primary" disabled>Entrar em contato</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
