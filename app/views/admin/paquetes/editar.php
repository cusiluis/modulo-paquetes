<?php
include APP_ROOT . '/app/core/globales.inc.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Editar Paquete</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/adminlte.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
  <!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
              <h1>Editar Paquete</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <form method="POST" action="<?= BASE_URL ?>paquetes/editar" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $paquete['id'] ?>">

            <div class="mb-3">
              <label>Nombre</label>
              <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($paquete['nombre']) ?>" required>
            </div>

            <div class="mb-3">
              <label>Descripción</label>
              <textarea name="descripcion" class="form-control" required><?= htmlspecialchars($paquete['descripcion']) ?></textarea>
            </div>

                <div class="mb-3">
                  <label for="includes" class="form-label">Incluye</label>
                  <select id="includes" name="includes[]" class="form-select" multiple required>
                      <?php
                      $idsIncluidos = explode(',', $paquete['includes_ids'] ?? '');
                      ?>
                      <?php foreach ($includes as $include): ?>
                        <option value="<?= $include['id'] ?>"
                          <?= in_array($include['id'], $idsIncluidos) ? 'selected' : '' ?>>
                          <?= $include['titulo'] ?>
                        </option>
                      <?php endforeach; ?>
                  </select>
                </div>

            <div class="mb-3">
              <label>Imagen actual:</label><br>
              <?php if (!empty($paquete['imagen'])): ?>
                <img src="<?= BASE_URL ?>public/uploads/paquetes/<?= $paquete['imagen'] ?>" alt="Imagen actual" class="img-thumbnail" width="200">
              <?php else: ?>
                <p><em>No hay imagen</em></p>
              <?php endif; ?>
            </div>

            <div class="mb-3">
              <label>Reemplazar Imagen</label>
              <input type="hidden" name="imagen_actual" value="<?= htmlspecialchars($paquete['imagen']) ?>">
              <input type="file" name="imagen" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
              <label>Mensaje de acción</label>
              <input type="text" name="mensaje_accion" class="form-control" value="<?= htmlspecialchars($paquete['mensaje_accion']) ?>" required>
            </div>

            <div class="mb-3">
              <label>Precio (€)</label>
              <input type="number" name="precio" class="form-control" step="0.01" value="<?= $paquete['precio'] ?>" required>
            </div>

            <div class="mb-3">
              <label>Duración (días)</label>
              <input type="number" name="duracion_dias" class="form-control" value="<?= $paquete['duracion_dias'] ?>" required>
            </div>

            <div class="mb-3">
              <label>Frecuencia</label>
              <select name="frecuencia" class="form-control" required>
                <option value="">---</option>
                <option value="semanal" <?= $paquete['frecuencia'] == 'semanal' ? 'selected' : '' ?>>Semanal</option>
                <option value="mensual" <?= $paquete['frecuencia'] == 'mensual' ? 'selected' : '' ?>>Mensual</option>
              </select>
            </div>

            <div class="mb-3">
              <div class="form-check form-switch">
                <input name="es_personalizado"
                      class="form-check-input"
                      type="checkbox"
                      role="switch"
                      id="switchCheckDefault"
                      value=""
                      <?= isset($paquete['es_personalizado']) && $paquete['es_personalizado'] ? 'checked' : '' ?>>
                <label class="form-check-label" for="switchCheckDefault">Es Personalizado</label>
              </div>
            </div>
       

            <button class="btn btn-primary">Actualizar Paquete</button>
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
