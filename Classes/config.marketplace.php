<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hivedb");

// Parâmetros da URL
$busca = $_GET['busca'] ?? '';
$categoria_filtro = $_GET['categoria'] ?? '';

// Buscar categorias para filtro lateral (nova tabela marketplace)
$categorias_result = $conn->query("SELECT id, nome FROM categorias_marketplace ORDER BY nome");

// Query base
$sql = "
    SELECT 
        p.*, 
        cm.nome AS categoria_nome, 
        u.nome AS usuario_nome, 
        u.foto_perfil
    FROM produtos p
    JOIN categorias_marketplace cm ON p.categoria_id = cm.id
    JOIN usuarios u ON p.usuario_id = u.id
    WHERE 1=1
";

// Condições da busca
$params = [];
$tipos = "";

if ($busca) {
    $sql .= " AND (p.titulo LIKE ? OR cm.nome LIKE ?)";
    $busca_like = "%$busca%";
    $params[] = &$busca_like;
    $params[] = &$busca_like;
    $tipos .= "ss";
}

if ($categoria_filtro) {
    $sql .= " AND cm.id = ?";
    $params[] = &$categoria_filtro;
    $tipos .= "i";
}

$sql .= " ORDER BY p.criado_em DESC";

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($tipos, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
