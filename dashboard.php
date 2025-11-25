<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['nome'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hive - Início</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

  <?php include 'navbar.php'; ?>

  <!-- Boas-vindas -->
  <section class="text-center py-16">
    <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700">Bem-vindo à Hive, <?= htmlspecialchars($usuario) ?>! 👋</h1>
    <p class="mt-4 text-lg text-gray-600 max-w-xl mx-auto">Aqui você pode explorar recursos para migrantes se conectarem, aprenderem e se apoiarem.</p>
  </section>

  <!-- Carrossel -->
  <div class="relative w-full max-w-4xl mx-auto mb-12">
    <div class="overflow-hidden rounded-xl shadow-lg">
      <img class="w-full h-64 object-cover" src="images/hivebackground.png" alt="Imagem Hive">
    </div>
  </div>

  <!-- Cards com funcionalidades -->
  <section class="max-w-6xl mx-auto px-4 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Marketplace 🛒</h3>
      <p class="text-gray-600 mb-4">Compre, venda ou anuncie produtos. Ideal para encontrar ou oferecer itens úteis.</p>
      <a href="marketplace.php" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Acessar</a>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Meu Perfil 🙋‍♂️</h3>
      <p class="text-gray-600 mb-4">Veja e edite suas informações, atualize sua foto de perfil e mais.</p>
      <a href="perfil.php" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Ver Perfil</a>
    </div>

    <!-- Card 3 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Comunidade 🤝</h3>
      <p class="text-gray-600 mb-4">Conecte-se com outros migrantes e compartilhe experiências no fórum.</p>
      <a href="#" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Entrar</a>
    </div>

    <!-- Card 4 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Notícias 🌍</h3>
      <p class="text-gray-600 mb-4">Acompanhe notícias e atualizações úteis para quem vive em outro país.</p>
      <a href="#" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Ler agora</a>
    </div>

    <!-- Card 5 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Serviços 📋</h3>
      <p class="text-gray-600 mb-4">Encontre serviços locais úteis: documentação, apoio psicológico, entre outros.</p>
      <a href="servicos.php" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Consultar</a>
    </div>

    <!-- Card 6 -->
    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition">
      <h3 class="text-xl font-bold text-indigo-700 mb-2">Ajuda 📞</h3>
      <p class="text-gray-600 mb-4">Precisa de suporte? Veja os canais de atendimento ou entre em contato.</p>
      <a href="contato.php" class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition">Contato</a>
    </div>
  </section>

  <!-- Rodapé -->
  <footer class="mt-20 bg-indigo-700 text-white text-center py-4">
    <small>© 2025 Hive. Todos os direitos reservados.</small>
  </footer>
</body>
</html>
