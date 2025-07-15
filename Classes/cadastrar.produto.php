<?php
session_start();

$conn = new mysqli("localhost", "root", "", "hivedb");
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o usuário está logado
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$usuario_nome = $_SESSION['nome'];

// Busca o ID do usuário com base no nome
$stmtUsuario = $conn->prepare("SELECT id FROM usuarios WHERE nome = ?");
$stmtUsuario->bind_param("s", $usuario_nome);
$stmtUsuario->execute();
$resultadoUsuario = $stmtUsuario->get_result();

if ($resultadoUsuario->num_rows === 0) {
    die("Usuário não encontrado no banco.");
}

$usuario = $resultadoUsuario->fetch_assoc();
$usuario_id = $usuario['id'];

$erro_upload = null;
$titulo = $descricao = $preco = $categoria = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = trim($_POST["titulo"] ?? '');
    $descricao = trim($_POST["descricao"] ?? '');
    $preco = $_POST["preco"] ?? '';
    $categoria = $_POST["categoria_id"] ?? '';

    // Validação dos campos
    if (
        $titulo === '' ||
        $descricao === '' ||
        !is_numeric($preco) || floatval($preco) < 0 ||
        !filter_var($categoria, FILTER_VALIDATE_INT)
    ) {
        $erro_upload = "Preencha todos os campos corretamente.";
    } else {
        $preco = floatval($preco);
        $categoria = intval($categoria);
        $imagem = null;

        // Upload de imagem
        if (!empty($_FILES["imagem"]["name"])) {
            $upload_dir = "uploads/";

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $file_tmp = $_FILES["imagem"]["tmp_name"];
            $file_name = $_FILES["imagem"]["name"];
            $file_size = $_FILES["imagem"]["size"];
            $file_type = mime_content_type($file_tmp);

            $ext_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            $max_size = 5 * 1024 * 1024; // 5MB

            if (!in_array($ext, $ext_permitidas)) {
                $erro_upload = "Tipo de arquivo não permitido. Use jpg, jpeg, png, gif ou webp.";
            } elseif ($file_size > $max_size) {
                $erro_upload = "Arquivo muito grande. Máximo 5MB.";
            } elseif (strpos($file_type, "image/") !== 0) {
                $erro_upload = "Arquivo não é uma imagem válida.";
            } else {
                $novo_nome = uniqid("img_") . "." . $ext;
                $imagem = $upload_dir . $novo_nome;

                if (!move_uploaded_file($file_tmp, $imagem)) {
                    $erro_upload = "Erro ao salvar a imagem no servidor.";
                }
            }
        }

        // Se não houve erro, insere no banco
        if (!$erro_upload) {
            $stmt = $conn->prepare("INSERT INTO produtos (titulo, descricao, preco, categoria_id, usuario_id, imagem) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdiss", $titulo, $descricao, $preco, $categoria, $usuario_id, $imagem);
            
            if ($stmt->execute()) {
                header("Location: marketplace.php");
                exit;
            } else {
                $erro_upload = "Erro ao inserir no banco: " . $stmt->error;
            }
        }
    }
}

// Carregar categorias para o select
$categorias = $conn->query("SELECT * FROM categorias ORDER BY nome");

?>
