<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
//echo "<pre>";
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

  <!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
              <h1>Nuevo Paquete</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">

        <form method="POST" action="<?php echo BASE_URL; ?>paquetes/guardar" enctype="multipart/form-data">
            <div class="container mt-4">

                <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" value="" placeholder="PACK PREMIUM">
                </div>

                <div class="mb-3">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control" placeholder="Tu Anuncio en lo mas Alto..."></textarea>
                </div>


                  <?php
                  //print_r($includes);
                  // Convertir includes_ids (string) a array
                  $idsIncluidos = isset($paquete['includes_ids']) ? explode(',', $paquete['includes_ids']) : [];
                  ?>

                  <div class="mb-3">
                    <label for="includes" class="form-label">Incluye</label>
                    <select id="includes" name="includes[]" class="form-select" multiple required>
                      <?php foreach ($includes as $include): ?>
                        <option value="<?= $include['id'] ?>"
                          <?= in_array($include['id'], $idsIncluidos) ? 'selected' : '' ?>>
                          <?= $include['titulo'] ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>





                <div class="mb-3">
                    <label>Imagen (archivo JPG/PNG)</label>
                    <input type="file" name="imagen" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                <label>Mensaje de acción</label>
                <input type="text" name="mensaje_accion" class="form-control" value="" placeholder="Quiero estar en todos lados y facturar más">
                </div>

                <div class="mb-3">
                <label>Precio (€)</label>
                <input type="number" step="0.01" name="precio" class="form-control" value="" placeholder="22.30">
                </div>
 
                
                <div class="mb-3">
                <label>Duracion(dias)</label>
                <input type="number"  name="duracion_dias" class="form-control" value="" placeholder="15">
                </div>                   

                <div class="mb-3">
                <label>Frecuencia</label>
                <select name="frecuencia" class="form-control">
                    <option value="">---</option>
                    <option value="semanal">Semanal</option>
                    <option value="mensual">Mensual</option>
                </select>
                </div>

                <div class="mb-3">
                  <div class="form-check form-switch">
                    <input name="es_personalizado"
                          class="form-check-input"
                          type="checkbox"
                          role="switch"
                          id="switchCheckDefault"
                          value="">
                    <label class="form-check-label" for="switchCheckDefault">Es Personalizado</label>
                  </div>
                </div>

                <button class="btn btn-primary">Guardar Paquete</button>
            </div>
        </form>


   

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


<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
  $(document).ready(function () {
    $('#includes').select2({
      placeholder: "Selecciona una o varias opciones",
      allowClear: true,
      closeOnSelect: false
    });
  });
</script>



</body>

</html>
