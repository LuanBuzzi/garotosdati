<?php
$conn = new mysqli("localhost", "root", "", "hivedb");
$resultado = $conn->query("SELECT * FROM servicos ORDER BY criado_em DESC");

while ($s = $resultado->fetch_assoc()) {
  echo "<div class='border p-4 rounded mb-4'>";
  echo "<h3 class='font-bold text-lg'>{$s['titulo']}</h3>";
  echo "<p>{$s['descricao']}</p>";
  echo "<p><strong>Categoria:</strong> {$s['categoria']}</p>";
  echo "<p><strong>Preço:</strong> {$s['preco']}</p>";
  echo "<p><strong>Contato:</strong> {$s['contato']}</p>";
  echo "<p class='text-sm text-gray-500'>Publicado por {$s['autor']} em {$s['criado_em']}</p>";
  echo "</div>";
}
?>
