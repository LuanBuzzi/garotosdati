<?php
include 'Classes/cadastrar.produto.php';
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Cadastrar Produto - Hive</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/cadastro.produto.css">
</head>

<body class="py-5">

  <div class="form-container">
    <h1><i class="bi bi-box-seam-fill"></i> Cadastrar Produto</h1>

    <?php if ($erro_upload): ?>
      <div class="alert alert-danger text-center" role="alert">
        <?= htmlspecialchars($erro_upload) ?>
      </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" novalidate>
      <div class="mb-3">
        <label for="titulo" class="form-label">Título do Produto</label>
        <input type="text" class="form-control" name="titulo" id="titulo" required
               placeholder="Ex: Sapato de Couro"
               value="<?= isset($titulo) ? htmlspecialchars($titulo) : '' ?>" />
      </div>

      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" rows="4" required
                  placeholder="Descreva o produto com detalhes..."><?= isset($descricao) ? htmlspecialchars($descricao) : '' ?></textarea>
      </div>

      <div class="mb-3">
        <label for="preco" class="form-label">Preço (R$)</label>
        <input type="number" step="0.01" min="0" class="form-control" name="preco" id="preco" required
               placeholder="Ex: 59.90"
               value="<?= isset($preco) ? htmlspecialchars($preco) : '' ?>" />
      </div>

      <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <select name="categoria_id" id="categoria" class="form-select" required>
          <option value="">Selecione...</option>
          <?php
          // Reexecutar query para garantir que os dados não estejam esgotados
          $categorias = $conn->query("SELECT id, nome FROM categorias_marketplace ORDER BY nome");

          while ($cat = $categorias->fetch_assoc()) { ?>
            <option value="<?= $cat['id'] ?>" <?= (isset($categoria) && $categoria == $cat['id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($cat['nome']) ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="imagem" class="form-label">Imagem do Produto</label>
        <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*" />
        <div class="form-text">Opcional. Tipos permitidos: jpg, jpeg, png, gif, webp. Máximo 5MB.</div>
      </div>

      <div class="d-grid mt-4">
        <button type="submit" class="btn btn-primary btn-lg">
          <i class="bi bi-upload"></i> Publicar Produto
        </button>
      </div>
    </form>
  </div>

</body>
</html>
