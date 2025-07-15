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

$stmt = $conn->prepare("SELECT nome, email, pais_origem, pais_residencia, foto_perfil FROM usuarios WHERE nome = ?");
$stmt->bind_param("s", $usuario_logado);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();

// URL do placeholder externo
$imagem_placeholder = "https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png";

// Verifica se foto_perfil existe e o arquivo está acessível no servidor
// Se não, usa o placeholder externo
if (!$usuario['foto_perfil'] || !file_exists($usuario['foto_perfil'])) {
    $fotoPerfil = $imagem_placeholder;
} else {
    $fotoPerfil = $usuario['foto_perfil'];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil - Hive</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'navbar.php'; ?>

<body class="bg-gradient-to-b from-indigo-100 to-white min-h-screen py-10">
  <br><br>
  <div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-xl p-8">
    <h1 class="text-4xl font-bold text-center text-indigo-700 mb-8">Meu Perfil</h1>

    <!-- Foto e Upload -->
    <div class="flex flex-col items-center mb-8">
      <img src="<?= htmlspecialchars($fotoPerfil) ?>" 
           alt="Foto de perfil"
           class="w-36 h-36 rounded-full border-4 border-indigo-500 object-cover shadow-md mb-4">

      <form method="POST" enctype="multipart/form-data" class="w-full max-w-xs text-center">
        <label class="block text-sm font-medium text-gray-700 mb-1">Trocar foto de perfil</label>
        <input type="file" name="nova_foto" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-indigo-100 file:text-indigo-700
                      hover:file:bg-indigo-200 mb-3" required>
        <button type="submit"
                class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition">Atualizar Foto</button>
      </form>
    </div>

    <!-- Informações do Usuário -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">Nome 🙋‍♂️</h2>
        <p><?= htmlspecialchars($usuario['nome']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">Email 📩</h2>
        <p><?= htmlspecialchars($usuario['email']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">País de Origem 🐣</h2>
        <p><?= htmlspecialchars($usuario['pais_origem']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">País de Residência 🏠</h2>
        <p><?= htmlspecialchars($usuario['pais_residencia']) ?></p>
      </div>
    </div>

    <!-- Ações -->
    <div class="mt-10 flex justify-center space-x-4">
      <a href="editar_perfil.php" 
         class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition">Editar Perfil</a>
      <a href="logout.php" 
         class="px-6 py-2 rounded-full border border-red-500 text-red-600 hover:bg-red-50 transition">Sair</a>
    </div>
  </div>
</body>
</html>
