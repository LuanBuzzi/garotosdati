<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$usuario_logado = $_SESSION['nome'];

// Processar upload de imagem
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["nova_foto"])) {
    $foto = $_FILES["nova_foto"];
    if ($foto["error"] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($foto["name"], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid() . "." . strtolower($extensao);
        $caminho = "uploads/" . $nome_arquivo;

        // Cria pasta se não existir
        if (!is_dir("uploads")) {
            mkdir("uploads", 0777, true);
        }

        if (move_uploaded_file($foto["tmp_name"], $caminho)) {
            $stmt = $conn->prepare("UPDATE usuarios SET foto_perfil = ? WHERE nome = ?");
            $stmt->bind_param("ss", $caminho, $usuario_logado);
            $stmt->execute();
        }
    }
}

// Buscar os dados do usuário
$stmt = $conn->prepare("SELECT nome, email, pais_origem, pais_residencia, foto_perfil FROM usuarios WHERE nome = ?");
$stmt->bind_param("s", $usuario_logado);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil - Hive</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md mt-10 text-center">
    <h1 class="text-3xl font-bold mb-6">Meu Perfil</h1>

    <!-- Foto de perfil -->
    <div class="mb-4">
      <img src="<?= $usuario['foto_perfil'] ? htmlspecialchars($usuario['foto_perfil']) : 'https://via.placeholder.com/150' ?>" 
           alt="Foto de perfil" 
           class="w-32 h-32 mx-auto rounded-full object-cover border">
    </div>

    <!-- Formulário para trocar a foto -->
    <form method="POST" enctype="multipart/form-data" class="mb-6">
      <label class="block mb-2 text-sm font-medium text-gray-700">Trocar foto de perfil</label>
      <input type="file" name="nova_foto" accept="image/*" required class="mb-2">
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Atualizar Foto</button>
    </form>

    <!-- Dados do usuário -->
    <div class="space-y-2 text-left">
      <div><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></div>
      <div><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></div>
      <div><strong>País de Origem:</strong> <?= htmlspecialchars($usuario['pais_origem']) ?></div>
      <div><strong>País de Residência:</strong> <?= htmlspecialchars($usuario['pais_residencia']) ?></div>
    </div>

    <div class="mt-6">
      <a href="editar_perfil.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Editar Perfil</a>
      <a href="logout.php" class="ml-4 text-red-600 underline">Sair</a>
    </div>
  </div>
</body>
</html>
