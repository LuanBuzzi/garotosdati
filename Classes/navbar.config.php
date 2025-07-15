<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("localhost", "root", "", "hivedb");

$fotoPerfil = 'https://upload.wikimedia.org/wikipedia/commons/8/89/Portrait_Placeholder.png';
$pagina_atual = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['nome'])) {
    $usuario_logado = $_SESSION['nome'];
    $stmt = $conn->prepare("SELECT foto_perfil FROM usuarios WHERE nome = ?");
    $stmt->bind_param("s", $usuario_logado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_assoc();

    if (!empty($dados['foto_perfil'])) {
        $fotoPerfil = htmlspecialchars($dados['foto_perfil']);
    }
}

?>