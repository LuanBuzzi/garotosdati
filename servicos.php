<?php
include 'Classes/Servicos.class.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Serviços Freelancers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/servicos.css">
    <?php include 'navbar.php'; ?>
</head>
<body class="bg-light">

<div class="container py-4">

    <h2 class="mb-4 text-center">Serviços disponíveis</h2>
    <div class="row">
        <?php if ($servicos->num_rows > 0): ?>
            <?php while ($servico = $servicos->fetch_assoc()): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (!empty($servico['anexo']) && file_exists($servico['anexo'])): ?>
                            <img src="<?= htmlspecialchars($servico['anexo']) ?>" class="card-img-top" alt="Anexo do serviço">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/400x180?text=Sem+imagem" class="card-img-top" alt="Sem imagem">
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($servico['titulo']) ?></h5>
                            <p class="card-text flex-grow-1"><?= nl2br(htmlspecialchars($servico['descricao'])) ?></p>
                            <span class="badge bg-primary mb-2"><?= htmlspecialchars($servico['categoria_nome']) ?></span>
                            <p class="mb-1"><strong>Preço:</strong> <?= htmlspecialchars($servico['preco']) ?: 'A combinar' ?></p>
                            <p class="mb-2"><strong>Contato:</strong> <?= htmlspecialchars($servico['contato']) ?></p>
                            <p class="text-muted small mb-0 mt-auto">
                                Por <?= htmlspecialchars($servico['autor']) ?> em <?= date("d/m/Y H:i", strtotime($servico['criado_em'])) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">Nenhum serviço disponível no momento.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Botão discreto para abrir o formulário -->
<button id="btnCriarServico" class="btn btn-success" title="Oferecer um serviço" data-bs-toggle="modal" data-bs-target="#modalServico">+</button>

<!-- Modal do formulário -->
<div class="modal fade" id="modalServico" tabindex="-1" aria-labelledby="modalServicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalServicoLabel">Ofereça um serviço</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input type="text" name="titulo" class="form-control" placeholder="Ex: Corto grama na região" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select name="categoria_id" class="form-select" required>
                    <option value="">Selecione</option>
                    <?php 
                    // Recarregar categorias para o modal (pois o fetch_assoc do anterior pode ter consumido)
                    $categorias = $conn->query("SELECT * FROM categorias");
                    while ($cat = $categorias->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($cat['id']) ?>"><?= htmlspecialchars($cat['nome']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Preço</label>
                <input type="text" name="preco" class="form-control" placeholder="Ex: R$50 ou a combinar">
            </div>

            <div class="mb-3">
                <label class="form-label">Contato (WhatsApp, e-mail...)</label>
                <input type="text" name="contato" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Anexo (imagem ou documento opcional)</label>
                <input type="file" name="anexo" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Publicar serviço</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
