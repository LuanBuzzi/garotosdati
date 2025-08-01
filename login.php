<?php
include 'Classes/login.config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - Hive</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6">Entrar na Hive</h1>

    <?php if ($erro): ?>
      <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
        <?= htmlspecialchars($erro) ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <div>
        <label for="email" class="block text-sm font-medium">Email</label>
        <input type="email" name="email" id="email" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <div>
        <label for="senha" class="block text-sm font-medium">Senha</label>
        <input type="password" name="senha" id="senha" class="w-full border border-gray-300 p-2 rounded" required>
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
        Entrar
      </button>
    </form>

    <p class="text-center mt-4 text-sm">
      Ainda não tem conta?
      <a href="registro.php" class="text-blue-600 underline">Cadastre-se</a>
    </p>
  </div>
</body>
</html>
