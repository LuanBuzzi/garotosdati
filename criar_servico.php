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

<form method="POST" class="max-w-xl mx-auto p-6 bg-white rounded shadow space-y-4">
  <h2 class="text-xl font-bold">Ofereça um serviço</h2>
  <input type="text" name="titulo" placeholder="Ex: Corto grama na região central" class="w-full p-2 border rounded" required>
  <textarea name="descricao" placeholder="Descreva o que você faz..." class="w-full p-2 border rounded" rows="4" required></textarea>
  <input type="text" name="categoria" placeholder="Categoria (ex: jardinagem, edição, aulas)" class="w-full p-2 border rounded">
  <input type="text" name="preco" placeholder="Preço (ex: R$50/hora ou 'a combinar')" class="w-full p-2 border rounded">
  <input type="text" name="contato" placeholder="WhatsApp ou e-mail para contato" class="w-full p-2 border rounded" required>
  <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Publicar serviço</button>
</form>
