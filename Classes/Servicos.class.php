<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['nome'];

// Processa o formulário ao receber POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $categoria = $_POST["categoria_id"];
    $preco = $_POST["preco"];
    $contato = $_POST["contato"];
    $autor = $nomeUsuario;

    // Lida com upload de anexo (imagem ou documento)
    $anexo = "";
    if (!empty($_FILES["anexo"]["name"])) {
        $pastaUpload = "uploads/";
        if (!is_dir($pastaUpload)) {
            mkdir($pastaUpload, 0777, true);
        }

        $caminhoArquivo = $pastaUpload . basename($_FILES["anexo"]["name"]);

        if (move_uploaded_file($_FILES["anexo"]["tmp_name"], $caminhoArquivo)) {
            $anexo = $caminhoArquivo;
        }
    }

    $dataHora = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO servicos (titulo, descricao, categoria_id, preco, contato, autor, anexo, criado_em) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisssss", $titulo, $descricao, $categoria, $preco, $contato, $autor, $anexo, $dataHora);
    $stmt->execute();

    header("Location: servicos.php");
    exit;
}

$categorias = $conn->query("SELECT * FROM categorias");
$servicos = $conn->query("
    SELECT s.*, c.nome AS categoria_nome 
    FROM servicos s 
    JOIN categorias c ON s.categoria_id = c.id 
    ORDER BY s.criado_em DESC
");
?>
