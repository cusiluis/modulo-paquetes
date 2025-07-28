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

</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">

  <div class="app-wrapper">

    <!-- Header -->
    <?php include "includes/header.php" ?>

    <!-- Sidebar -->
    <?php include "includes/sidebar.php" ?>

    <!-- Main Content -->
    <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Administración de Usuarios</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <table id="usuarios" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Tipo</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($usuarios as $u) : ?>
                <tr>
                  <td><?= $u['id'] ?></td>
                  <td><?= $u['nombre'] ?></td>
                  <td><?= $u['email'] ?></td>
                  <td><?= $u['rol'] ?></td>
                  <td>
                    <a href="<?php echo BASE_URL; ?>usuarios/detalle/<?= $u['id'] ?>" class="btn btn-sm btn-info">Ver</a>
                    <a href="<?php echo BASE_URL; ?>usuarios/historial?usuario=<?= $u['id'] ?>" class="btn btn-sm btn-info">Historial</a>
                    <a href="index.php?r=admin_impersonar&usuario=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Ingresar como</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

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
