<?php
$conn = new mysqli("localhost", "root", "", "hivedb");

$erro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $pais_origem = trim($_POST["pais_origem"]);
    $pais_residencia = trim($_POST["pais_residencia"]);

    // Exemplo: a tabela 'usuarios' precisa ter as colunas pais_origem e pais_residencia
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, pais_origem, pais_residencia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $senha, $pais_origem, $pais_residencia);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro ao registrar. Tente outro e-mail.";
    }
}
?>