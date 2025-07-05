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
  <link rel="stylesheet" href="/public/adminlte/css/adminlte.css">

  <!-- Iconos opcionales -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

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
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Historial</th>
                        <th>Paquete</th>
                        <th>Fecha Compra</th>
                        <th>Fecha Expiración</th>
                        <th>Cantidad Publicaciones</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($historial)): ?>
                        <?php foreach ($historial as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['id']) ?></td>
                                <td><?= htmlspecialchars($item['nombre_paquete'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($item['fecha_compra']))) ?></td>
                                <td><?= htmlspecialchars(date('d/m/Y', strtotime($item['fecha_expiracion']))) ?></td>
                                <td><?= htmlspecialchars($item['cantidad_publicaciones']) ?></td>
                                <td>
                                    <?php
                                        switch ($item['estado']) {
                                            case 'activo': echo '<span class="badge badge-success">Activo</span>'; break;
                                            case 'expirado': echo '<span class="badge badge-danger">Expirado</span>'; break;
                                            default: echo '<span class="badge badge-secondary">Desconocido</span>'; break;
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">No hay registros de paquetes.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
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
  <script src="/public/adminlte/js/adminlte.js"></script>

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
