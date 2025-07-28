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
    <?php include "../includes/header.php" ?>

    <!-- Sidebar -->
    <?php include "../includes/sidebar.php" ?>

    <!-- Main Content -->
    <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Ver Escort</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <h2 class="mb-4"><?= $escort ? 'Editar' : 'Nuevo' ?> Escort</h2>

          <form method="POST" action="<?php echo BASE_URL; ?>admin/escorts/guardar" class="needs-validation" novalidate>
            <?php if ($escort): ?>
              <input type="hidden" name="ID" value="<?= htmlspecialchars($escort['ID']) ?>">
            <?php endif; ?>

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" id="nombre" name="Nombre" class="form-control" value="<?= htmlspecialchars($escort['Nombre'] ?? '') ?>" required>
              <div class="invalid-feedback">Por favor, ingresa el nombre.</div>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="Email" class="form-control" value="<?= htmlspecialchars($escort['Email'] ?? '') ?>" required>
              <div class="invalid-feedback">Por favor, ingresa un email válido.</div>
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="text" id="telefono" name="Telefono" class="form-control" value="<?= htmlspecialchars($escort['Telefono'] ?? '') ?>" required>
              <div class="invalid-feedback">Por favor, ingresa el teléfono.</div>
            </div>

            <div class="mb-3">
              <label for="ciudadid" class="form-label">Ciudad ID</label>
              <input type="text" id="ciudadid" name="CiudadID" class="form-control" value="<?= htmlspecialchars($escort['CiudadID'] ?? '') ?>" required>
              <div class="invalid-feedback">Por favor, ingresa la ciudad.</div>
            </div>

            <div class="mb-3">
              <label for="vip" class="form-label">VIP</label>
              <input type="text" id="vip" name="vip" class="form-control" value="<?= htmlspecialchars($escort['vip'] ?? '') ?>">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>

          <script>
          // Ejemplo simple para validación Bootstrap 5
          (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
              form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                  event.preventDefault()
                  event.stopPropagation()
                }
                form.classList.add('was-validated')
              }, false)
            })
          })()
          </script>

        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include "../includes/footer.php" ?>

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
