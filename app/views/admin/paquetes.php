<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Administración de Paquetes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Accesibilidad y Meta Básicos -->
  <meta name="color-scheme" content="light dark">
  <meta name="theme-color" content="#007bff">

  <!-- Estilos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" media="print" onload="this.media='all'">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/adminlte/css/adminlte.css">
   <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/style-admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
          <a href="<?php echo BASE_URL; ?>admin/paquetes/crear" class="btn btn-primary btn-success-crear"><i class="fa-solid fa-file-invoice"></i> Nuevo Paquete</a>
        </div>
 <div class="table-responsive">
        <table class="table table-striped table-outer" width="100%">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Frecuencia</th>
              <th>Duración</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
          <?php if (isset($paquetes) && is_array($paquetes) && count($paquetes) > 0): ?>
            <?php foreach ($paquetes as $p): ?>
              <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td style="font-weight: 700;"><?= htmlspecialchars($p['nombre']) ?></td>
                <td>$<?= number_format($p['precio'], 2) ?></td>
                <td><?= htmlspecialchars($p['frecuencia']) ?></td>
                <td><?= htmlspecialchars($p['duracion_dias']) ?> días</td>
                <td>
                  <div class="form-check form-switch" style="display:inline">
                    <input 
                      name="activo"
                      class="form-check-input toggle-activo"
                      type="checkbox"
                      role="switch"
                      id="activoSwitch<?= $p['id'] ?>"
                      data-id="<?= $p['id'] ?>"
                      <?= isset($p['activo']) && $p['activo'] ? 'checked' : '' ?>>
                  </div>

                  <a href="<?= BASE_URL ?>paquetes/actualizar/<?= $p['id'] ?>" class="btn btn-sm btn-info btn-editar"><i class="fa-solid fa-file-pen"></i> Editar</a>

                  <button class="btn btn-sm btn-danger btn-eliminar" data-id="<?= $p['id'] ?>">
                    <i class="fa-solid fa-trash-arrow-up"></i> Eliminar
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

<!-- Toast Notificación -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="toastEstadoPaquete" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Estado del paquete actualizado correctamente.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>




<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>public/adminlte/js/adminlte.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
  jQuery(document).ready(function () {
    jQuery('.form-check-input[name="activo"]').on('change', function (e) {
      const checkbox = jQuery(this);
      const isChecked = checkbox.is(':checked');
      const paqueteId = checkbox.closest('tr').find('.btn-editar').attr('href').split('/').pop();

      const mensaje = isChecked 
        ? "¿Estás seguro de ACTIVAR este paquete?" 
        : "¿Estás seguro de DESACTIVAR este paquete?";

      // Confirmar antes de proceder
      if (!confirm(mensaje)) {
        checkbox.prop('checked', !isChecked); // Revertir estado
        return;
      }

      jQuery.ajax({
        url: '<?= BASE_URL ?>paquetes/toggle_activo',
        method: 'POST',
        data: { id: paqueteId, activo: isChecked ? 1 : 0 },
        success: function (response) {
          const toastEl = document.getElementById('toastEstadoPaquete');
          const toast = new bootstrap.Toast(toastEl);
          toast.show();
        }
      });
    });
  });
</script>



</body>
</html>
