<?php
$conn = new mysqli("localhost", "root", "", "hivedb");

$erro = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);
    $pais_origem = trim($_POST["pais_origem"]);
    $pais_residencia = trim($_POST["pais_residencia"]);

    // Exemplo: a tabela 'usuarios' precisa ter as colunas pais_origem e pais_residencia
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, pais_origem, pais_residencia) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nome, $email, $senha, $pais_origem, $pais_residencia);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        $erro = "Erro ao registrar. Tente outro e-mail.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Cadastro Hive - Registro</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Scrollbar estilizado para dropdown */
    #dropdownMenu::-webkit-scrollbar {
      width: 6px;
    }
    #dropdownMenu::-webkit-scrollbar-thumb {
      background-color: rgba(100, 100, 100, 0.4);
      border-radius: 3px;
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-900 p-6">
  <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md mt-10">
    <h1 class="text-3xl font-bold text-center mb-6">Criar Conta Hive</h1>

    <?php if ($erro): ?>
      <div class="text-red-600 mb-4"><?= htmlspecialchars($erro) ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">
      <input type="text" name="nome" placeholder="Nome completo" class="w-full border border-gray-300 p-2 rounded" required>
      <input type="email" name="email" placeholder="Email" class="w-full border border-gray-300 p-2 rounded" required>
      <input type="password" name="senha" placeholder="Senha" class="w-full border border-gray-300 p-2 rounded" required>

      <!-- País de origem (dropdown custom) -->
      <div>
        <label for="pais_origem_input" class="block mb-1 font-medium">País de origem:</label>
        <div class="relative">
          <button type="button" id="dropdownButton" class="w-full border border-gray-300 rounded px-3 py-2 text-left flex items-center justify-between focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <span id="selectedCountry" class="flex items-center gap-2 text-gray-700">Selecione um país</span>
            <svg class="w-4 h-4 ml-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div id="dropdownMenu" class="absolute z-20 w-full bg-white border border-gray-200 rounded shadow-md max-h-60 overflow-y-auto mt-1 hidden"></div>
          <input type="hidden" name="pais_origem" id="pais_origem_input" required />
        </div>
      </div>

      <!-- País onde reside (select simples) -->
      <div>
        <label for="pais_residencia" class="block mb-1 font-medium">País onde reside:</label>
        <select id="pais_residencia" name="pais_residencia" class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
          <option value="">Selecione um país</option>
        </select>
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">Registrar</button>
    </form>

    <p class="text-center mt-4 text-sm">Já tem conta? <a href="login.php" class="text-blue-600 underline">Entrar</a></p>
  </div>

<script>
  const allowedCountries = ["Estados Unidos", "Espanha", "Itália"];

  const dropdownButton = document.getElementById('dropdownButton');
  const dropdownMenu = document.getElementById('dropdownMenu');
  const selectedCountry = document.getElementById('selectedCountry');
  const hiddenInput = document.getElementById('pais_origem_input');
  const paisResidenciaSelect = document.getElementById('pais_residencia');

  // Fecha dropdown clicando fora
  function closeDropdownOnClickOutside(event) {
    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.classList.add('hidden');
    }
  }

  // Carrega países da API
  fetch('https://api-paises.pages.dev/paises.json')
    .then(res => res.json())
    .then(data => {
      // Dropdown custom para país de origem (todos os países)
      Object.values(data).forEach(country => {
        const option = document.createElement('div');
        option.className = 'flex items-center px-3 py-2 hover:bg-gray-100 cursor-pointer';
        option.innerHTML = `
          <img src="${country.img}" alt="bandeira" class="w-5 h-4 mr-2 object-cover rounded-sm border" />
          <span>${country.pais}</span>
        `;
        option.addEventListener('click', () => {
          selectedCountry.innerHTML = option.innerHTML;
          hiddenInput.value = country.pais;
          dropdownMenu.classList.add('hidden');
        });
        dropdownMenu.appendChild(option);
      });

      // Select para país onde reside (apenas países permitidos)
      allowedCountries.forEach(nome => {
        const found = Object.values(data).find(c => c.pais === nome);
        if (found) {
          const option = document.createElement('option');
          option.value = found.pais;
          option.textContent = found.pais;
          paisResidenciaSelect.appendChild(option);
        }
      });
    })
    .catch(err => {
      console.error('Erro ao carregar países:', err);
    });

  dropdownButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
  });

  document.addEventListener('click', closeDropdownOnClickOutside);
</script>

</body>
</html>
