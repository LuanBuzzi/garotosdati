<?php
include 'Classes/navbar.config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Navbar</title>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

 
  <nav class="bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
   
        <div class="flex-shrink-0">
          <a href="dashboard.php"><img class="h-8 w-8" src="images/hivelogowhite.png" alt="Logo"></a>
        </div>

        <div class="hidden sm:flex sm:space-x-4">
          <a href="dashboard.php" class="<?= $pagina_atual === 'dashboard.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
          <a href="forum.php" class="<?= $pagina_atual === 'forum.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Fórum</a>
          <a href="servicos.php" class="<?= $pagina_atual === 'servicos.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Serviços</a>
          <a href="marketplace.php" class="<?= $pagina_atual === 'marketplace.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Marketplace</a>
          <a href="dicas.php" class="<?= $pagina_atual === 'dicas.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Dicas</a>
          <a href="mapa.php" class="<?= $pagina_atual === 'dicas.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Mapa</a>
          <a href="Contato.php" class="<?= $pagina_atual === 'Contato.php' ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white' ?> px-3 py-2 rounded-md text-sm font-medium">Contato</a>
        </div>


        <div class="flex items-center space-x-4">

          <button class="text-gray-400 hover:text-white">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0018 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022 23.85 23.85 0 005.455 1.31m5.714 0a3 3 0 01-5.714 0"/>
            </svg>
          </button>

          <div class="relative">
            <button id="profile-button" class="flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
              <img class="h-8 w-8 rounded-full" src="<?= $fotoPerfil ?>" alt="User">
            </button>

            <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
              <a href="perfil.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Seu perfil</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Configurações</a>
              <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sair</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <script>
    const profileBtn = document.getElementById('profile-button');
    const dropdown = document.getElementById('dropdown-menu');

    profileBtn.addEventListener('click', () => {
      dropdown.classList.toggle('hidden');
    });


    document.addEventListener('click', (e) => {
      if (!profileBtn.contains(e.target) && !dropdown.contains(e.target)) {
        dropdown.classList.add('hidden');
      }
    });
  </script>

</body>
</html>
