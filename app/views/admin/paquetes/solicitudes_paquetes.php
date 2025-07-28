<?php
include APP_ROOT . '/app/core/globales.inc.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Solicitudes de Paquetes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
  <div class="app-wrapper">
    <?php include "app/views/admin/includes/header.php" ?>
    <?php include "app/views/admin/includes/sidebar.php" ?>

    <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Solicitudes de Paquetes</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
 
          <table class="table table-striped">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Usuario</th>
                      <th>Escort</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Fecha</th>
                      <th>Acción</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($solicitudes as $s): ?>
                  <tr>
                      <td><?= $s['id'] ?></td>
                      <td><?= $s['usuario_id'] ?></td>
                      <td><?= htmlspecialchars($s['nombre_escort']) ?></td>
                      <td><?= htmlspecialchars($s['descripcion']) ?></td>
                      <td><?= $s['estado'] ?></td>
                      <td><?= $s['fecha_creacion'] ?></td>
                      <td>
                          <?php if ($s['estado'] != 'aprobado'): ?>
                              <a href="<?php echo BASE_URL; ?>paquetes/asignar_paquete?id=<?= $s['id'] ?>&usuario_id=<?= $s['usuario_id'] ?>&escort_id=<?= $s['escort_id'] ?>&duracion_dias=<?= $s['escort_id'] ?>&paquete_id=<?= $s['paquete_id'] ?>&estado=aprobado">Aprobar</a>
                          <?php endif; ?>
                          <?php if ($s['estado'] != 'rechazado'): ?>
                              <a href="index.php?r=cambiar_estado&id=<?= $s['id'] ?>&estado=rechazado">Rechazar</a>
                          <?php endif; ?>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>

        </div>
      </section>
    </main>

    <?php include "app/views/admin/includes/footer.php" ?>
  </div>

<!-- Toast Notificación -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="toastEstadoPaquete" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        Estado de Opcion de paquete actualizado correctamente.
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Cerrar"></button>
    </div>
  </div>
</div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>public/adminlte/js/adminlte.js"></script>


  <!-- DataTables + Bootstrap 5 -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- DataTables Configuración -->
  <script>
  jQuery(document).ready(function () {
    jQuery('.form-check-input[name="activo"]').on('change', function (e) {
      const checkbox = jQuery(this);
      const isChecked = checkbox.is(':checked');
      const OpaqueteId = checkbox.closest('tr').find('.btn-editar').attr('href').split('/').pop();

      const mensaje = isChecked 
        ? "¿Estás seguro de ACTIVAR esta Opcion de paquete?" 
        : "¿Estás seguro de DESACTIVAR esta Opcion de paquete?";

      // Confirmar antes de proceder
      if (!confirm(mensaje)) {
        checkbox.prop('checked', !isChecked); // Revertir estado
        return;
      }

      jQuery.ajax({
        url: '<?= BASE_URL ?>opciones_paquetes/toggle_activo',
        method: 'POST',
        data: { id: OpaqueteId, activo: isChecked ? 1 : 0 },
        success: function (response) {
          const toastEl = document.getElementById('toastEstadoPaquete');
          const toast = new bootstrap.Toast(toastEl);
          toast.show();
        }
      });

    });
  });

  $(document).ready(function () {
      $('#opcionesp').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
  });
  </script>

</body>
</html>
