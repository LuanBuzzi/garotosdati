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
  <title>Hive - Contato</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-white to-indigo-50 min-h-screen">

  <?php include 'navbar.php'; ?>


  <section class="text-center py-12">
    <h1 class="text-4xl md:text-5xl font-extrabold text-indigo-700">Entre em contato 📞</h1>
    <p class="mt-4 text-lg text-gray-600 max-w-xl mx-auto">Tem dúvidas, sugestões ou precisa de ajuda? Fale com a equipe Hive.</p>
  </section>

  <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-12 pb-20">

    <div class="bg-white p-8 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-indigo-700 mb-6">Envie uma mensagem</h2>
      <form action="#" method="POST" class="space-y-4">
        <div>
          <label class="block text-gray-700 font-medium mb-1">Nome</label>
          <input type="text" name="nome" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1">E-mail</label>
          <input type="email" name="email" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
        </div>
        <div>
          <label class="block text-gray-700 font-medium mb-1">Mensagem</label>
          <textarea name="mensagem" rows="5" required class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition font-semibold">Enviar</button>
      </form>
    </div>


    <div class="bg-white p-8 rounded-xl shadow-md">
      <h2 class="text-2xl font-bold text-indigo-700 mb-6">Nossos canais</h2>
      <ul class="space-y-6 text-gray-700">
        <li>
          <span class="font-semibold text-indigo-700">📍 Endereço:</span><br>
          Rua 7 de Setembro, 147 - Rio do Oeste, SC
        </li>
        <li>
          <span class="font-semibold text-indigo-700">📧 E-mail:</span><br>
          suporte@hive.com
        </li>
        <li>
          <span class="font-semibold text-indigo-700">📞 Telefone:</span><br>
          (47) 98824-2543
        </li>
        <li>
          <span class="font-semibold text-indigo-700">⏰ Atendimento:</span><br>
          Segunda a Sexta, 9h às 18h
        </li>
      </ul>
    </div>
  </div>

  <!-- Rodapé -->
  <footer class="mt-10 bg-indigo-700 text-white text-center py-4">
    <small>© 2025 Hive. Todos os direitos reservados.</small>
  </footer>
</body>
</html>
