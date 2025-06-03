<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

$usuario_id = $_SESSION['usuario_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST["titulo"];
    $descricao = $_POST["descricao"];
    $preco = $_POST["preco"];
    $categoria = $_POST["categoria_id"];

    $imagem = null;
    if (!empty($_FILES["imagem"]["name"])) {
        $upload_dir = "uploads/";
        $imagem = $upload_dir . basename($_FILES["imagem"]["name"]);
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $imagem);
    }

    $stmt = $conn->prepare("INSERT INTO produtos (titulo, descricao, preco, categoria_id, usuario_id, imagem) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdiis", $titulo, $descricao, $preco, $categoria, $usuario_id, $imagem);
    $stmt->execute();

    header("Location: marketplace.php");
    exit;
}

$categorias = $conn->query("SELECT * FROM categorias");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastrar Produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container py-5">

<h1>Cadastrar Produto</h1>

<form method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo" id="titulo" required />
    </div>
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" name="descricao" id="descricao" rows="4" required></textarea>
    </div>
    <div class="mb-3">
        <label for="preco" class="form-label">Preço (R$)</label>
        <input type="number" step="0.01" min="0" class="form-control" name="preco" id="preco" required />
    </div>
    <div class="mb-3">
        <label for="categoria" class="form-label">Categoria</label>
        <select name="categoria_id" id="categoria" class="form-select" required>
            <option value="">Selecione...</option>
            <?php while ($cat = $categorias->fetch_assoc()) { ?>
                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nome']) ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem do Produto</label>
        <input type="file" class="form-control" name="imagem" id="imagem" accept="image/*" />
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
</form>

</body>
</html>
