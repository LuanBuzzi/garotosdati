<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>HIVE - Mapa Colaborativo</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <style>
    #map {
      height: 500px;
      width: 100%;
    }
  </style>

  <?php include 'navbar.php'; ?>
</head>
<body>
  <h1>Mapa da Comunidade HIVE</h1>
  <p>Clique no mapa para adicionar um ponto de interesse.</p>

  <div id="map"></div>

  <?php

    $conn = new mysqli("localhost", "root", "", "hivedb");
    $result = $conn->query("SELECT * FROM pontos_interesse");

    $dados = [];
    while ($row = $result->fetch_assoc()) {
      $dados[] = $row;
    }
    $conn->close();
  ?>

  <script>
    const map = L.map('map').setView([40.416598, -3.703814], 25);


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);


    const pontosSalvos = <?php echo json_encode($dados); ?>;
    pontosSalvos.forEach(p => {
      L.marker([p.lat, p.lng]).addTo(map)
        .bindPopup(`<strong>${p.titulo}</strong><br>${p.descricao}`);
    });


    map.on('click', function(e) {
      const lat = e.latlng.lat;
      const lng = e.latlng.lng;

      const marker = L.marker([lat, lng]).addTo(map);

      marker.bindPopup(`
  <form action="classes/salvar_ponto.php" method="POST" class="p-2" style="min-width: 250px;">
    <input type="hidden" name="lat" value="${lat}" />
    <input type="hidden" name="lng" value="${lng}" />

    <div class="mb-2">
      <label class="form-label"><strong>Título</strong></label>
      <input type="text" name="titulo" class="form-control form-control-sm" placeholder="Ex: Mercado local" required>
    </div>

    <div class="mb-2">
      <label class="form-label"><strong>Descrição</strong></label>
      <textarea name="descricao" class="form-control form-control-sm" rows="2" placeholder="Dê uma dica, conte o que há aqui..." required></textarea>
    </div>

    <button type="submit" class="btn btn-sm btn-primary w-100">Salvar ponto</button>
  </form>
`).openPopup();
    });
  </script>
</body>
</html>
