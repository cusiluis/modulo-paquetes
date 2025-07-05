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
  <link rel="stylesheet" href="/public/adminlte/css/adminlte.css">
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
              <th>Acciones</th>
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
                <td>

                  <button class="btn btn-sm btn-info btn-editar" 
                    data-id="<?= $p['id'] ?>" 
                    data-nombre="<?= htmlspecialchars($p['nombre']) ?>" 
                    data-precio="<?= $p['precio'] ?>"
                    data-cantidad_publicaciones="<?= $p['cantidad_publicaciones'] ?>"
                    data-duracion_dias="<?= $p['duracion_dias'] ?>"
                    data-es_personalizado="<?= $p['es_personalizado'] ?>" 
                    data-descripcion="<?= htmlspecialchars($p['descripcion']) ?>">
                    Editar
                  </button>

                  <button class="btn btn-sm btn-danger btn-eliminar" data-id="<?= $p['id'] ?>">
                    Eliminar
                  </button>
                </td>
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
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" min="0" step="0.01" required>
              </div>

              <div class="mb-3">
                <label for="cantidad_publicaciones" class="form-label">Cantidad Publicaciones</label>
                <input type="number" class="form-control" id="cantidad_publicaciones" name="cantidad_publicaciones" min="0" required>
              </div> 
              
              <div class="mb-3">
                <label for="duracion_dias" class="form-label">Duracion</label>
                <input type="number" class="form-control" id="duracion_dias" name="duracion_dias" min="0" required>
              </div>              

              <div class="mb-3">
                <label for="es_personalizado" class="form-label">Tipo</label>
                <select class="form-select" id="es_personalizado" name="es_personalizado" required>
                  <option value="">---</option>
                  <option value="0">Fijo</option>
                  <option value="1">Personalizado</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Crear</button>
            </form>
          </div>

        </div>
      </div>
    </div>

    <!-- Modal Editar Paquete -->
    <div class="modal fade" id="editarPaqueteModal" tabindex="-1" aria-labelledby="editarPaqueteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
        
          <div class="modal-header">
            <h5 class="modal-title" id="editarPaqueteModalLabel">Editar Paquete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <form id="formEditarPaquete" method="POST">
              <input type="hidden" id="editar_id" name="id">

                <div class="mb-3">
                  <label for="editar_nombre" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="editar_nombre" name="nombre" required>
                </div>

                <div class="mb-3">
                  <label for="editar_precio" class="form-label">Precio</label>
                  <input type="number" class="form-control" id="editar_precio" name="precio" min="0" step="0.01" required>
                </div>

                <div class="mb-3">
                  <label for="editar_cantidad_publicaciones" class="form-label">Cantidad Publicaciones</label>
                  <input type="number" class="form-control" id="editar_cantidad_publicaciones" name="cantidad_publicaciones" min="0" required>
                </div> 
                
                <div class="mb-3">
                  <label for="editar_duracion_dias" class="form-label">Duracion</label>
                  <input type="number" class="form-control" id="editar_duracion_dias" name="duracion_dias" min="0" required>
                </div>              

                <div class="mb-3">
                  <label for="editar_es_personalizado" class="form-label">Tipo</label>
                  <select class="form-select" id="editar_es_personalizado" name="es_personalizado" required>
                    <option value="">---</option>
                    <option value="0">Fijo</option>
                    <option value="1">Personalizado</option>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="editar_descripcion" class="form-label">Descripcion</label>
                  <textarea name="descripcion" id="editar_descripcion" class="form-control" required></textarea>
                </div>

              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
<script src="/public/adminlte/js/adminlte.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", () => {

    // Crear paquete AJAX
    const formCrear = document.getElementById("formCrearPaquete");
    formCrear.addEventListener("submit", e => {
      e.preventDefault();
      const datos = {
        nombre: document.getElementById("nombre").value,
        precio: document.getElementById("precio").value,
        cantidad_publicaciones: document.getElementById("cantidad_publicaciones").value,
        duracion_dias: document.getElementById("duracion_dias").value,
        es_personalizado: document.getElementById("es_personalizado").value,
        descripcion: document.getElementById("descripcion").value
      };

      fetch("/paquete_crear", { 
        method: "POST", 
        body: JSON.stringify(datos), 
        headers: { "Content-Type": "application/json" } 
      })

      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("Paquete creado correctamente.");
          location.reload();
        } else {
          alert(data.message || "Error al crear el paquete.");
        }
      });
    });

    // Abrir modal editar
    document.querySelectorAll(".btn-editar").forEach(btn => {
      btn.addEventListener("click", () => {
        document.getElementById("editar_id").value = btn.dataset.id;
        document.getElementById("editar_nombre").value = btn.dataset.nombre;
        document.getElementById("editar_precio").value = btn.dataset.precio;
        document.getElementById("editar_cantidad_publicaciones").value = btn.dataset.cantidad_publicaciones;
        document.getElementById("editar_duracion_dias").value = btn.dataset.duracion_dias;
        document.getElementById("editar_es_personalizado").value = btn.dataset.es_personalizado;
        document.getElementById("editar_descripcion").value = btn.dataset.descripcion;
        const modal = new bootstrap.Modal(document.getElementById("editarPaqueteModal"));
        modal.show();
      });
    });

    // Editar paquete AJAX
    const formEditar = document.getElementById("formEditarPaquete");
    formEditar.addEventListener("submit", e => {
      e.preventDefault();
      const datos = {
        id: document.getElementById("editar_id").value,
        nombre: document.getElementById("editar_nombre").value,
        precio: document.getElementById("editar_precio").value,
        cantidad_publicaciones: document.getElementById("editar_cantidad_publicaciones").value,
        duracion_dias: document.getElementById("editar_duracion_dias").value,
        es_personalizado: document.getElementById("editar_es_personalizado").value,
        descripcion: document.getElementById("editar_descripcion").value
      };

      fetch("/paquete_editar", { 
        method: "POST", 
        body: JSON.stringify(datos), 
        headers: { "Content-Type": "application/json" } 
      })

      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert("Paquete actualizado correctamente.");
          location.reload();
        } else {
          alert(data.message || "Error al actualizar el paquete.");
        }
      });
    });

    // Eliminar paquete
    document.querySelectorAll(".btn-eliminar").forEach(btn => {
      btn.addEventListener("click", () => {
        if (confirm("¿Eliminar este paquete?")) {

          fetch("/paquete_eliminar", { 
            method: "POST", 
            body: JSON.stringify({ id: btn.dataset.id }), 
            headers: { "Content-Type": "application/json" } 
          })

          .then(res => res.json())
          .then(data => {
            if (data.success) {
              alert("Paquete eliminado.");
              location.reload();
            } else {
              alert(data.message || "Error al eliminar.");
            }
          });
        }
      });
    });

  });

</script>

</body>
</html>
