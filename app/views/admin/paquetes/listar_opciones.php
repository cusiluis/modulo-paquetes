<?php
include APP_ROOT . '/app/core/globales.inc.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Opciones de Paquetes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/adminlte.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/style-admin.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
   <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
              <h1>Opciones de Paquetes</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
 
          <a href="<?= BASE_URL ?>paquetes/crear_opciones" class="btn btn-success-crear mb-3"><i class="fa-solid fa-file-invoice"></i> Crear nueva opción</a>
           
          
          <div class="table-responsive">
          <table id="opcionesp" class="table table-striped table-outer" width="100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Portal</th>
                <th>Días</th>
                <th>Veces/día</th>
                <th>Precio subida</th>
                <th>Precio total</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($opciones as $op): ?>
                <tr>
                  <td><?= $op['id'] ?></td>
                  <td style="font-weight: 700;"><?= htmlspecialchars($op['titulo']) ?></td>
                  <td><?= htmlspecialchars($op['nombre_portal']) ?></td>
                  <td><?= $op['duracion_dias'] ?></td>
                  <td><?= $op['veces_dia'] ?></td>
                  <td>€<?= number_format($op['precio_subida'], 2) ?></td>
                  <td>€<?= number_format($op['precio_total'], 2) ?></td>
                  <td>

                    <div class="form-check form-switch" style="display:inline">
                      <input 
                        name="activo"
                        class="form-check-input toggle-activo"
                        type="checkbox"
                        role="switch"
                        id="activoSwitch<?= $op['id'] ?>"
                        data-id="<?= $op['id'] ?>"
                        <?= isset($op['activo']) && $op['activo'] ? 'checked' : '' ?>>
                    </div>

                    <a href="<?= BASE_URL ?>paquetes/actualizar_opciones/<?= $op['id'] ?>" class="btn btn-sm btn-info btn-editar"><i class="fa-solid fa-file-pen"></i> Editar</a>
                    <a href="<?= BASE_URL ?>paquetes/elimina_opciones/<?= $op['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta opción?')"><i class="fa-solid fa-trash-arrow-up"></i> Eliminar</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
 </div>
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
