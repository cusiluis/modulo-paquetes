<?php
include APP_ROOT . '/app/core/globales.inc.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crear Opción de Paquete</title>

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
              <h1>Crear Opción de Paquete</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
 
          <form method="POST" action="<?= BASE_URL ?>paquetes/guarda_opciones">

            <div class="mb-3">
              <label>Título</label>
              <input type="text" name="titulo" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Nombre del Portal</label>
              <input type="text" name="nombre_portal" class="form-control">
            </div>
            <div class="mb-3">
              <label>Descripción del Portal</label>
              <textarea name="descripcion_portal" class="form-control"></textarea>
            </div>
            <div class="mb-3">
              <label>Días de duración</label>
              <input type="number" name="duracion_dias" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Subidas por día</label>
              <input type="number" name="veces_dia" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Precio por subida (€)</label>
              <input type="number" step="0.001" name="precio_subida" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Precio total (€)</label>
              <input type="number" step="0.01" name="precio_total" class="form-control" placeholder="(subidas/dia * precio por subida) * dias duracion" readonly required>
            </div>
            <button type="submit" class="btn btn-success">Crear</button>
          </form>

        </div>
      </section>
    </main>

    <?php include "app/views/admin/includes/footer.php" ?>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>public/adminlte/js/adminlte.js"></script>

<script>
  function calcularPrecioTotal() {
    const duracion = parseFloat(document.querySelector('input[name="duracion_dias"]').value) || 0;
    const vecesDia = parseFloat(document.querySelector('input[name="veces_dia"]').value) || 0;
    const precioSubida = parseFloat(document.querySelector('input[name="precio_subida"]').value) || 0;

    const total = (vecesDia * precioSubida) * duracion;

    let resultadoFinal = total;

    // Si tiene decimales, preguntar si desea redondear hacia arriba
    if (!Number.isInteger(total)) {
      const redondeado = Math.ceil(total);
      const aceptar = confirm(`El total calculado es ${total.toFixed(2)}€. ¿Deseas redondearlo a ${redondeado}€?`);
      if (aceptar) {
        resultadoFinal = redondeado;
      }
    }

    document.querySelector('input[name="precio_total"]').value = resultadoFinal.toFixed(2);
  }

  document.addEventListener('DOMContentLoaded', () => {
    ['duracion_dias', 'veces_dia', 'precio_subida'].forEach(name => {
      const input = document.querySelector(`input[name="${name}"]`);
      if (input) {
        input.addEventListener('input', calcularPrecioTotal);
      }
    });
  });
</script>




</body>
</html>
