<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hivedb");

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['nome'];

$id = intval($_GET['id'] ?? 0);
$topico = $conn->query("SELECT t.*, c.nome AS categoria_nome FROM topicos t 
                        JOIN categorias c ON t.categoria_id = c.id 
                        WHERE t.id = $id")->fetch_assoc();

$respostas = $conn->query("SELECT * FROM respostas WHERE topico_id = $id ORDER BY data_resposta ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resposta = $_POST["resposta"];
    $stmt = $conn->prepare("INSERT INTO respostas (topico_id, autor, resposta) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $nomeUsuario, $resposta);
    $stmt->execute();
    header("Location: topico.php?id=$id");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($topico['titulo']) ?> - Hive Fórum</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  
  <?php include 'navbar.php'; ?>

  <br><br>
  <!-- Tópico -->
  <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-2"><?= htmlspecialchars($topico['titulo']) ?></h1>
    <p class="text-gray-600 mb-1">Categoria: <?= htmlspecialchars($topico['categoria_nome']) ?></p>
    <p class="text-sm text-gray-500">por <?= htmlspecialchars($topico['autor']) ?> em <?= date('d/m/Y H:i', strtotime($topico['data_criacao'])) ?></p>
    <p class="mt-4"><?= nl2br(htmlspecialchars($topico['descricao'])) ?></p>

    <?php if ($topico['anexo']): ?>
      <div class="mt-4">
        📎 <a href="<?= htmlspecialchars($topico['anexo']) ?>" target="_blank" class="text-blue-500 underline">Ver anexo</a>
      </div>
    <?php endif; ?>
  </div>

  <!-- Respostas -->
  <div class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Respostas</h2>
    <?php while ($r = $respostas->fetch_assoc()): ?>
      <div class="border-t pt-3 mt-3">
        <p class="text-gray-800"><?= nl2br(htmlspecialchars($r['resposta'])) ?></p>
        <div class="text-sm text-gray-500 mt-1">por <?= htmlspecialchars($r['autor']) ?> em <?= date('d/m/Y H:i', strtotime($r['data_resposta'])) ?></div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Responder -->
  <div class="max-w-3xl mx-auto mt-6 bg-white p-6 rounded shadow">
    <h3 class="text-lg font-semibold mb-2">Responder</h3>
    <form method="POST" class="space-y-3">
      <textarea name="resposta" placeholder="Sua resposta..." rows="4" class="w-full border p-2 rounded" required></textarea>
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Enviar resposta</button>
    </form>
  </div>
</body>
</html>
