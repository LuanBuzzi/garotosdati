<?php

session_start();

$conn = new mysqli("localhost", "root", "", "hivedb");

// Verifica se usuário está logado
if (!isset($_SESSION['nome'])) {
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

    $dataHora = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO topicos (titulo, descricao, categoria_id, autor, anexo, criado_em) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $titulo, $descricao, $categoria, $autor, $anexo, $dataHora);
    $stmt->execute();

    header("Location: forum.php");
    exit;
}

$categorias = $conn->query("SELECT * FROM categorias");

?>