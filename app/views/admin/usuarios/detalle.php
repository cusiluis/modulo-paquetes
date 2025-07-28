<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Detalle Usuario - Administración</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- DataTables CSS con Bootstrap 5 -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

  <!-- AdminLTE 4 CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/adminlte/css/adminlte.css" />

  <!-- Iconos opcionales -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
  />
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
              <h1>Detalle del Usuario: <?= htmlspecialchars($usuario['nombre'] ?? $usuario['email']) ?></h1>
              <a href="<?php echo BASE_URL; ?>admin/usuarios" class="btn btn-secondary mt-2">← Volver a Usuarios</a>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">

          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Datos Básicos</h3>
            </div>
            <div class="card-body">
              <p><strong>ID:</strong> <?= htmlspecialchars($usuario['id']) ?></p>
              <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
              <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
              <p><strong>Tipo de Cuenta:</strong> <?= htmlspecialchars($usuario['rol']) ?></p>
              <!-- <p><strong>Registrado el:</strong> <?= htmlspecialchars(date('d/m/Y', strtotime($usuario['fecha_registro']))) ?></p> -->
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Paquete Activo</h3>
            </div>
            <div class="card-body">
                   
          <?php if ($paquetes_activos): ?>
              <div class="alert alert-success">
                  <strong><?= $paquetes_activos['nombre'] ?></strong><br>
                  Válido hasta: <?= $paquetes_activos['fecha_fin'] ?>
              </div>
          <?php else: ?>
              <div class="alert alert-warning">No tienes un paquete activo.</div>
          <?php endif; ?>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Historial de Paquetes</h3>
            </div>
            <div class="card-body">
              <?php if (!empty($historial)): ?>
              <table class="table">
              <thead><tr><th>Paquete</th><th>Inicio</th><th>Fin</th><th>Estado</th></tr></thead>
              <tbody>
                  <?php foreach($historial as $h): ?>
                      <tr>
                          <td><?= $h['nombre'] ?></td>
                          <td><?= $h['fecha_inicio'] ?></td>
                          <td><?= $h['fecha_fin'] ?></td>
                          <td><?= ucfirst($h['estado']) ?></td>
                      </tr>
                  <?php endforeach; ?>
              </tbody>
            </table>   
              <?php else: ?>
              <p>No hay historial de paquetes.</p>
              <?php endif; ?>
            </div>
          </div>

          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Escorts Asociados</h3>
            </div>
            <div class="card-body">
              <?php if (!empty($escorts)): ?>
              <table id="escorts-asociados" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID Escort</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($escorts as $e): ?>
                  <tr>
                    <td><?= htmlspecialchars($e['ID']) ?></td>
                    <td><?= htmlspecialchars($e['Nombre']) ?></td>
                    <td><?= htmlspecialchars($e['Email']) ?></td>
                    <td><?= htmlspecialchars($e['Telefono']) ?></td>
                    <!-- <td><?= $e['Publico'] ? 'Activo' : 'Inactivo' ?></td> -->
                    <td>
                      <?php
                        switch ($e['Publico']) {
                          case 1:
                            echo 'Activo';
                            break;
                          case 3:
                            echo 'Pendiente de aprobación';
                            break;
                          default:
                            echo 'Inactivo';
                        }
                      ?>
                    </td>

                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <?php else: ?>
              <p>No hay escorts asociados.</p>
              <?php endif; ?>
            </div>
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
      $('#paquetes-activos').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
      $('#historial-paquetes').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
      $('#escorts-asociados').DataTable({
        responsive: true,
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
        }
      });
    });
  </script>
</body>

</html>
