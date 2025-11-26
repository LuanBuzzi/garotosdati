<?php
include 'Classes/perfil.class.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Perfil - Hive</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php include 'navbar.php'; ?>

<body class="bg-gradient-to-b from-indigo-100 to-white min-h-screen py-10">
  <br><br>
  <div class="max-w-3xl mx-auto bg-white shadow-2xl rounded-xl p-8">
    <h1 class="text-4xl font-bold text-center text-indigo-700 mb-8">Meu Perfil</h1>


    <div class="flex flex-col items-center mb-8">
      <img src="<?= htmlspecialchars($fotoPerfil) ?>" 
           alt="Foto de perfil"
           class="w-36 h-36 rounded-full border-4 border-indigo-500 object-cover shadow-md mb-4">

      <form method="POST" enctype="multipart/form-data" class="w-full max-w-xs text-center">
        <label class="block text-sm font-medium text-gray-700 mb-1">Trocar foto de perfil</label>
        <input type="file" name="nova_foto" accept="image/*"
               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                      file:rounded-full file:border-0
                      file:text-sm file:font-semibold
                      file:bg-indigo-100 file:text-indigo-700
                      hover:file:bg-indigo-200 mb-3" required>
        <button type="submit"
                class="bg-indigo-600 text-white px-5 py-2 rounded-full hover:bg-indigo-700 transition">Atualizar Foto</button>
      </form>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">Nome 🙋‍♂️</h2>
        <p><?= htmlspecialchars($usuario['nome']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">Email 📩</h2>
        <p><?= htmlspecialchars($usuario['email']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">País de Origem 🐣</h2>
        <p><?= htmlspecialchars($usuario['pais_origem']) ?></p>
      </div>
      <div class="bg-indigo-50 p-4 rounded-lg shadow-sm">
        <h2 class="font-semibold text-sm text-indigo-600 mb-1">País de Residência 🏠</h2>
        <p><?= htmlspecialchars($usuario['pais_residencia']) ?></p>
      </div>
    </div>

    
    <div class="mt-10 flex justify-center space-x-4">
      <a href="editar_perfil.php" 
         class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition">Editar Perfil</a>
      <a href="logout.php" 
         class="px-6 py-2 rounded-full border border-red-500 text-red-600 hover:bg-red-50 transition">Sair</a>
    </div>
  </div>
</body>
</html>
