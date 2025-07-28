<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de Usuarios</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- DataTables CSS con Bootstrap 5 -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <!-- AdminLTE 4 CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/adminlte/css/adminlte.css">

  <!-- Iconos opcionales -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/style-admin.css" />
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

  <div class="app-wrapper">

    <!-- Header -->
    <?php include "app/views/admin/includes/header.php" ?>

    <!-- Sidebar -->
    <?php include "app/views/admin/includes/sidebar.php" ?>

    <!-- Main Content -->
    <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Historial de Paquetes del Usuario: <?= htmlspecialchars($usuario['nombre'] ?? $usuario['email'] ?? 'Usuario') ?></h1>
              <a href="<?php echo BASE_URL; ?>admin/usuarios" class="btn btn-secondary mt-2">← Volver a Usuarios</a>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="table-responsive">
        <div class="container-fluid">

            <table class="table table-striped table-outer" width="100%">
              <thead><tr><th>Paquete</th><th>Inicio</th><th>Fin</th><th>Estado</th></tr></thead>
              <tbody>
                  <?php foreach($historial as $h): ?>
                      <tr>
                          <td style="font-weight: 700;"><?= $h['nombre'] ?></td>
                          <td><?= $h['fecha_inicio'] ?></td>
                          <td><?= $h['fecha_fin'] ?></td>
                          <td><?= ucfirst($h['estado']) ?></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>   
        </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include "app/views/admin/includes/footer.php" ?>

  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <!-- Bootstrap 5 Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE 4 -->
  <script src="<?php echo BASE_URL; ?>public/adminlte/js/adminlte.js"></script>

  <!-- DataTables + Bootstrap 5 -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- DataTables Configuración -->
  <script>
    $(document).ready(function () {
      $('#usuarios').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
    });
  </script>

</body>

</html>
