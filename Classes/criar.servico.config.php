<?php

session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['nome'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria"];
    $preco = $_POST["preco"];
    $contato = $_POST["contato"];

    $stmt = $conn->prepare("INSERT INTO servicos (titulo, descricao, categoria, preco, contato, autor) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $titulo, $descricao, $categoria, $preco, $contato, $usuario);
    $stmt->execute();

    header("Location: servicos.php");
    exit;
}

?>