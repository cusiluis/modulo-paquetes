<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Administración Principal</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Accesibilidad y Meta Básicos -->
  <meta name="color-scheme" content="light dark">
  <meta name="theme-color" content="#007bff">

  <!-- Estilos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="public/adminlte/css/adminlte.css">
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
<div class="app-wrapper">

  <?php include "includes/header.php"; ?>
  <?php include "includes/sidebar.php"; ?>

  <main class="app-main">
    
    <section class="content header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administración de Paquetes</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="mb-3">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearPaqueteModal">
            Crear Paquete
          </button>
        </div>

        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Publicaciones</th>
              <th>Duración</th>
            </tr>
          </thead>
          <tbody>
          <?php if (isset($paquetes) && is_array($paquetes) && count($paquetes) > 0): ?>
            <?php foreach ($paquetes as $p): ?>
              <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td>$<?= number_format($p['precio'], 2) ?></td>
                <td><?= htmlspecialchars($p['cantidad_publicaciones']) ?></td>
                <td><?= htmlspecialchars($p['duracion_dias']) ?> días</td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="5" class="text-center">No hay paquetes registrados.</td></tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>

    <!-- Modal Crear Paquete -->
    <div class="modal fade" id="crearPaqueteModal" tabindex="-1" aria-labelledby="crearPaqueteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <div class="modal-header">
            <h5 class="modal-title" id="crearPaqueteModalLabel">Crear Paquete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <form id="formCrearPaquete" method="POST">
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>

              <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo" required>
                  <option value="fijo">Fijo</option>
                  <option value="personalizado">Personalizado</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
              </div>

              <button type="submit" class="btn btn-primary">Crear</button>
            </form>
          </div>

        </div>
      </div>
    </div>

  </main>

  <?php include "includes/footer.php"; ?>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="public/adminlte/js/adminlte.js"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {
  
  // Scrollbar Sidebar
  const sidebarWrapper = document.querySelector(".sidebar-wrapper");
  if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars) {
    OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
      scrollbars: {
        theme: "os-theme-light",
        autoHide: "leave",
        clickScroll: true
      }
    });
  }

  // Crear paquete vía AJAX
  const form = document.getElementById("formCrearPaquete");
  form.addEventListener("submit", function(e) {
    e.preventDefault();
    
    const datos = {
      nombre: document.getElementById("nombre").value,
      tipo: document.getElementById("tipo").value,
      precio: document.getElementById("precio").value
    };

    fetch("crear_paquete.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify(datos)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("Paquete creado correctamente.");
        location.reload();
      } else {
        alert(data.message || "Error al crear el paquete.");
      }
    })
    .catch(err => console.error("Error:", err));
  });

});
</script>

</body>
</html>
