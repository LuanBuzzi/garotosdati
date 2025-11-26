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

    </style>
</head>

<body class="bg-light">

<div class="container-fluid py-4">
    <div class="row">

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


        <main class="col-md-9 col-lg-9">
            <h1 class="mb-4">Marketplace</h1>


            <div class="mb-4 d-flex justify-content-end">
                <a href="cadastro_produto.php" class="btn btn-success">+ Criar Produto</a>
            </div>


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

<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content border-0 rounded-3 shadow-lg">
      <div class="modal-body p-0">
        <div class="row g-0">
          <div class="col-lg-7 bg-dark d-flex align-items-center justify-content-center">
            <?php if ($produto['imagem'] && file_exists($produto['imagem'])): ?>
              <img src="<?= htmlspecialchars($produto['imagem']) ?>" class="img-fluid rounded-start" alt="Imagem do produto" style="max-height: 90vh; object-fit: contain;">
            <?php else: ?>
              <img src="https://via.placeholder.com/600x600?text=Sem+Imagem" class="img-fluid rounded-start" alt="Sem imagem" style="max-height: 90vh; object-fit: contain;">
            <?php endif; ?>
          </div>

          <div class="col-lg-5 p-4 d-flex flex-column">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Fechar"></button>
            <h3 class="fw-bold mb-2"><?= htmlspecialchars($produto['titulo']) ?></h3>
            <p class="fs-4 text-success fw-semibold mb-3">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>

            <div class="d-flex align-items-center mb-4">
              <?php if (!empty($produto['foto_perfil']) && file_exists($produto['foto_perfil'])): ?>
                <img src="<?= htmlspecialchars($produto['foto_perfil']) ?>" alt="Foto do vendedor" class="rounded-circle me-3" width="50" height="50" style="object-fit: cover;">
              <?php else: ?>
                <img src="https://via.placeholder.com/50?text=U" alt="Foto do vendedor" class="rounded-circle me-3" width="50" height="50">
              <?php endif; ?>
              <div>
                <p class="mb-0 fw-semibold"><?= htmlspecialchars($produto['usuario_nome']) ?></p>
                <small class="text-muted">Vendedor</small>
              </div>
            </div>


            <p class="text-muted mb-3"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>


            <ul class="list-unstyled small text-muted mb-4">
              <li><strong>Categoria:</strong> <?= htmlspecialchars($produto['categoria_nome']) ?></li>
              <li><strong>Publicado em:</strong> <?= date('d/m/Y', strtotime($produto['criado_em'])) ?></li>
            </ul>


            <div class="mt-auto d-flex gap-2">
              <a href="contato.php?vendedor=<?= $produto['usuario_id'] ?>" class="btn btn-primary flex-fill">💬 Entrar em contato</a>
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
          </div>
        </div>
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
