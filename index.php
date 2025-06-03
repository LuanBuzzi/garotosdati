<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Hive - Comunidade para Migrantes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .carousel-caption {
      background: rgba(0, 0, 0, 0.5);
      border-radius: 8px;
      padding: 1rem;
    }

    .feature-icon {
      font-size: 2rem;
      color: #0d6efd;
    }
  </style>
</head>
<body>

  <!-- Carrossel -->
  <div id="carouselHive" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="https://images.unsplash.com/photo-1515162305281-9d51896c234f" class="d-block w-100" style="max-height: 550px; object-fit: cover;" alt="Conexões">
        <div class="carousel-caption">
          <h3>Bem-vindo à Hive</h3>
          <p>Conectando migrantes com suporte e oportunidades.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1517602302552-471fe67acf66" class="d-block w-100" style="max-height: 550px; object-fit: cover;" alt="Comunidade">
        <div class="carousel-caption">
          <h3>Fórum de Apoio</h3>
          <p>Tire dúvidas, compartilhe experiências e encontre ajuda por categorias.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="https://images.unsplash.com/photo-1556740749-887f6717d7e4" class="d-block w-100" style="max-height: 550px; object-fit: cover;" alt="Ferramentas">
        <div class="carousel-caption">
          <h3>Ferramentas úteis</h3>
          <p>Encontre indicações, profissionais confiáveis e serviços essenciais.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselHive" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselHive" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <!-- Seção de Apresentação -->
  <section class="py-5 text-center">
    <div class="container">
      <h2 class="fw-bold">O que é o Hive?</h2>
      <p class="lead">Hive é uma plataforma voltada para migrantes em busca de apoio, conexões e informações úteis para sua nova jornada em outro país.</p>
    </div>
  </section>

  <!-- Funcionalidades -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="feature-icon mb-2">🗣️</div>
          <h5 class="fw-bold">Fórum por Categorias</h5>
          <p>Participe de discussões sobre visto, idioma, moradia e integração cultural.</p>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-icon mb-2">🧭</div>
          <h5 class="fw-bold">Indicações confiáveis</h5>
          <p>Descubra profissionais indicados por outros migrantes, como advogados, médicos e tradutores.</p>
        </div>
        <div class="col-md-4 mb-4">
          <div class="feature-icon mb-2">🔒</div>
          <h5 class="fw-bold">Cadastro e Login Seguro</h5>
          <p>Segurança com login, criptografia de senha e controle de acesso.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Rodapé -->
  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <p class="mb-0">© 2025 Hive. Todos os direitos reservados.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
