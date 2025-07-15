<!DOCTYPE html>
<html lang="pt-BR" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hive - Comunidade para Migrantes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/index.css">
</head>
<body class="min-h-screen flex flex-col">

  <!-- Navbar -->
  <nav class="bg-indigo-700 fixed w-full top-0 z-50 shadow">
    <div class="container mx-auto px-4 flex justify-between items-center h-16">
      <a href="#" class="text-white text-2xl font-bold">Hive</a>
      <div class="hidden md:flex space-x-6 items-center">
        <a href="#sobre" class="text-indigo-100 hover:text-white font-semibold transition">Sobre</a>
        <a href="#funcionalidades" class="text-indigo-100 hover:text-white font-semibold transition">Funcionalidades</a>
        <a href="login.php" class="px-4 py-2 border border-white text-white rounded hover:bg-white hover:text-indigo-700 transition">Entrar</a>
        <a href="registro.php" class="px-4 py-2 bg-yellow-400 text-indigo-900 font-bold rounded hover:bg-yellow-300 transition">Cadastrar-se</a>
      </div>
      <!-- Mobile menu button -->
      <button id="btn-mobile-menu" class="md:hidden text-indigo-100 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"/></svg>
      </button>
    </div>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-indigo-700 px-4 pb-4">
      <a href="#sobre" class="block py-2 text-indigo-100 hover:text-white font-semibold transition">Sobre</a>
      <a href="#funcionalidades" class="block py-2 text-indigo-100 hover:text-white font-semibold transition">Funcionalidades</a>
      <a href="login.php" class="block py-2 px-4 border border-white text-white rounded hover:bg-white hover:text-indigo-700 transition mt-2 text-center">Entrar</a>
      <a href="registro.php" class="block py-2 px-4 bg-yellow-400 text-indigo-900 font-bold rounded hover:bg-yellow-300 transition mt-2 text-center">Cadastrar-se</a>
    </div>
  </nav>

  <main class="flex-grow pt-20">

    <!-- Carousel -->
    <section class="relative max-w-6xl mx-auto px-4 select-none">
      <div class="overflow-hidden rounded-lg shadow-lg relative">
        <!-- Slides -->
        <div class="carousel-slide relative w-full h-72 md:h-96">
          <img src="images/comunidade2.jpg" alt="Conexões" class="w-full h-full object-cover rounded-lg" />
          <div class="absolute bottom-6 left-6 carousel-caption text-white">
            <h3 class="text-xl font-bold mb-1">Bem-vindo à Hive</h3>
            <p class="mb-3">Conectando migrantes com suporte e oportunidades.</p>
            <a href="registro.php" class="inline-block bg-indigo-600 px-4 py-2 rounded text-white hover:bg-indigo-700 transition">Quero fazer parte</a>
          </div>
        </div>
      </div>
      <!-- You can add JS for real carousel or keep it static for now -->
    </section>

    <!-- Sobre -->
    <section id="sobre" class="py-16 max-w-4xl mx-auto px-4 text-center">
      <h2 class="text-4xl font-extrabold text-indigo-700 mb-6">O que é o Hive?</h2>
      <p class="text-lg text-gray-700 leading-relaxed">Hive é uma plataforma acolhedora feita para migrantes que buscam apoio, conexões e informações práticas em sua nova jornada.</p>
    </section>

    <!-- Funcionalidades -->
    <section id="funcionalidades" class="bg-indigo-50 py-16">
      <div class="max-w-6xl mx-auto px-4 grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3">
        <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition">
          <div class="text-4xl mb-4">🗣️</div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-2">Fórum por Categorias</h3>
          <p class="text-gray-600 mb-4">Participe de discussões sobre visto, idioma, moradia e integração cultural.</p>
          <a href="forum.php" class="inline-block text-indigo-600 font-semibold hover:underline">Acessar fórum</a>
        </div>
        <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition">
          <div class="text-4xl mb-4">🧭</div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-2">Indicações confiáveis</h3>
          <p class="text-gray-600 mb-4">Veja indicações de migrantes sobre médicos, advogados, tradutores e mais.</p>
          <a href="forum.php" class="inline-block text-indigo-600 font-semibold hover:underline">Ver indicações</a>
        </div>
        <div class="bg-white rounded-xl shadow p-6 hover:shadow-xl transition">
          <div class="text-4xl mb-4">🔒</div>
          <h3 class="text-xl font-semibold text-indigo-700 mb-2">Cadastro e Login Seguro</h3>
          <p class="text-gray-600 mb-4">Criptografia de senha e controle de acesso garantem sua segurança.</p>
          <a href="login.php" class="inline-block text-indigo-600 font-semibold hover:underline">Fazer login</a>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-indigo-700 text-indigo-100 text-center py-6">
    <p>© 2025 Hive. Todos os direitos reservados.</p>
    <div class="flex justify-center space-x-6 mt-2 text-2xl">
      <a href="#" aria-label="Facebook" class="hover:text-white"><i class="bi bi-facebook"></i></a>
      <a href="#" aria-label="Instagram" class="hover:text-white"><i class="bi bi-instagram"></i></a>
      <a href="#" aria-label="Twitter" class="hover:text-white"><i class="bi bi-twitter-x"></i></a>
    </div>
  </footer>

  <script>
    // Mobile menu toggle
    const btnMobileMenu = document.getElementById('btn-mobile-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    btnMobileMenu.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
