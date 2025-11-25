<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "hivedb";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

$sql = "INSERT INTO pontos_interesse (titulo, descricao, lat, lng)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdd", $titulo, $descricao, $lat, $lng);
$stmt->execute();

$stmt->close();
$conn->close();

echo "Ponto salvo com sucesso!";
?>
