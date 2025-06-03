<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hivedb");

// Verifica se usuário está logado
if (!isset($_SESSION['nome'])) {
    // Redireciona para login ou mostra erro
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['nome']; // nome do usuário logado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria_id"];
    $autor = $nomeUsuario;  // pega da sessão

    $anexo = "";
    if (!empty($_FILES["anexo"]["name"])) {
        $anexo = "uploads/" . basename($_FILES["anexo"]["name"]);
        move_uploaded_file($_FILES["anexo"]["tmp_name"], $anexo);
    }

    // Data/hora atual do servidor (PHP)
    $dataHora = date('Y-m-d H:i:s');

    // Ajustar a query para salvar dataHora também
    $stmt = $conn->prepare("INSERT INTO topicos (titulo, descricao, categoria_id, autor, anexo, criado_em) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $titulo, $descricao, $categoria, $autor, $anexo, $dataHora);
    $stmt->execute();

    header("Location: forum.php");
    exit;
}

$categorias = $conn->query("SELECT * FROM categorias");

?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
  <title>Novo Tópico</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

    <?php include 'navbar.php'; ?>


    <br><br>
<body class="bg-gray-100 p-8">
  <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Criar novo tópico</h2>
   <form method="POST" enctype="multipart/form-data" class="space-y-4">
  <!-- <input type="text" name="autor" placeholder="Seu nome" class="w-full border p-2 rounded" required> -->
  <input type="text" name="titulo" placeholder="Título" class="w-full border p-2 rounded" required>
  <textarea name="descricao" placeholder="Descrição" rows="5" class="w-full border p-2 rounded" required></textarea>
  <select name="categoria_id" class="w-full border p-2 rounded" required>
    <option value="">Selecione uma categoria</option>
    <?php while($cat = $categorias->fetch_assoc()): ?>
      <option value="<?= $cat['id'] ?>"><?= $cat['nome'] ?></option>
    <?php endwhile; ?>
  </select>
  <input type="file" name="anexo" class="w-full">
  <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Publicar</button>
</form>

  </div>
</body>
</html>
