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