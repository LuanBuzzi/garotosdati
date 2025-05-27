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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .welcome-section {
            background: linear-gradient(to right, #f8f9fa, #e0f0ff);
            padding: 40px 0;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #0d6efd;
        }
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Hive</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="me-3 text-muted">Olá, <?= htmlspecialchars($usuario) ?>!</span>
                <a href="logout.php" class="btn btn-outline-danger">Sair</a>
            </div>
        </div>
    </nav>

    <!-- Boas-vindas -->
    <section class="welcome-section text-center">
        <div class="container">
            <h1 class="fw-bold">Bem-vindo à Hive, <?= htmlspecialchars($usuario) ?>!</h1>
            <p class="lead">Explore recursos criados para ajudar migrantes a se conectarem, se informarem e se apoiarem.</p>
        </div>
    </section>

    <!-- Acesso rápido -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-3">
                        <div class="feature-icon mb-2">💬</div>
                        <h5 class="fw-bold">Fórum</h5>
                        <p>Participe de discussões por categoria e tire suas dúvidas.</p>
                        <a href="forum.php" class="btn btn-primary mt-2">Ir para o Fórum</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-3">
                        <div class="feature-icon mb-2">👥</div>
                        <h5 class="fw-bold">Minha Conta</h5>
                        <p>Veja e edite suas informações pessoais e preferências.</p>
                        <a href="perfil.php" class="btn btn-outline-primary mt-2">Ver Perfil</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm p-3">
                        <div class="feature-icon mb-2">🌍</div>
                        <h5 class="fw-bold">Indicações e Serviços</h5>
                        <p>Veja serviços úteis recomendados por outros migrantes.</p>
                        <a href="servicos.php" class="btn btn-outline-primary mt-2">Explorar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <small>© 2025 Hive. Todos os direitos reservados.</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
