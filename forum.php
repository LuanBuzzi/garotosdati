<?php
$conn = new mysqli("localhost", "root", "", "hivedb");
$categorias = $conn->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Fórum Hive</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Hive</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 text-muted">Olá, <?= htmlspecialchars($usuario) ?>!</span>
                <a href="logout.php" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
    </nav>

<body class="bg-gray-100 p-6">
  <div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">Fórum por Categorias</h1>
    <a href="criar_topico.php" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">Novo Tópico</a>
    
    <?php while ($cat = $categorias->fetch_assoc()): ?>
      <div class="bg-white p-4 rounded shadow mb-4">
        <h2 class="text-lg font-semibold mb-2"><?= $cat['nome'] ?></h2>
        <?php
          $cat_id = $cat['id'];
          $topicos = $conn->query("SELECT * FROM topicos WHERE categoria_id = $cat_id ORDER BY data_criacao DESC");
          while ($topico = $topicos->fetch_assoc()):
        ?>
          <div class="border-t pt-2 mt-2">
            <a href="topico.php?id=<?= $topico['id'] ?>" class="text-blue-600 font-medium"><?= $topico['titulo'] ?></a>
            <div class="text-sm text-gray-500">por <?= $topico['autor'] ?> em <?= date('d/m/Y H:i', strtotime($topico['data_criacao'])) ?></div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php endwhile; ?>
  </div>
</body>
</html>
