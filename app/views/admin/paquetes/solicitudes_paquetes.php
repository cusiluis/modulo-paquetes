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
  <link rel="stylesheet" href="<?= BASE_URL ?>public/adminlte/css/style-admin.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" />
   <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&amp;display=swap" rel="stylesheet">
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


         <div class="table-responsive">
          <table class="table table-striped table-outer" width="100%">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Usuario</th>
                      <th>Escort</th>
                      <th>Paquete Solicitado</th>
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
                      <td><?= htmlspecialchars($s['nombre_paquete']) ?></td>
                      <td><?= $s['estado'] ?></td>
                      <td><?= $s['fecha_creacion'] ?></td>
                      <td>
                        <?php if ($s['estado'] != 'aprobado'): ?>
                          <button type="button"
                                  class="btn btn-success btn-aprobar-solicitud btn-sm"
                                  data-nombre="<?= htmlspecialchars($s['nombre_escort']) ?>"
                                  data-url="<?= BASE_URL ?>paquetes/asignar_paquete?id=<?= $s['id'] ?>&usuario_id=<?= $s['usuario_id'] ?>&escort_id=<?= $s['escort_id'] ?>&duracion_dias=<?= $s['duracion_dias'] ?>&paquete_id=<?= $s['paquete_id'] ?>&estado=aprobado">
                            Aprobar
                          </button>

                        <?php endif; ?>

                        <?php if ($s['estado'] != 'rechazado' && $s['estado'] != 'aprobado'): ?>
                          <button type="button"
                                  class="btn btn-danger btn-rechazar-solicitud btn-sm"
                                  data-nombre="<?= htmlspecialchars($s['nombre_escort']) ?>"
                                  data-url="<?= BASE_URL ?>paquetes/rechazar_solicitud?id=<?= $s['id'] ?>">
                            Rechazar
                          </button>
                        <?php endif; ?>
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

  <!-- Modal Confirmar Aprobación -->
  <div class="modal fade" id="confirmarAprobacionModal" tabindex="-1" aria-labelledby="modalAprobacionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="modalAprobacionLabel">Confirmar Aprobación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body" id="mensajeAprobacion"></div>
        <div class="modal-footer">
          <a href="#" class="btn btn-success" id="btnConfirmarAprobacion">Sí, aprobar</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Confirmar Rechazo -->
  <div class="modal fade" id="confirmarRechazoModal" tabindex="-1" aria-labelledby="modalRechazoLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="modalRechazoLabel">Confirmar Rechazo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body" id="mensajeRechazo"></div>
        <div class="modal-footer">
          <a href="#" class="btn btn-danger" id="btnConfirmarRechazo">Sí, rechazar</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
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
  document.addEventListener('DOMContentLoaded', () => {
    // Modal Aprobar
    const modalAprobacion = new bootstrap.Modal(document.getElementById('confirmarAprobacionModal'));
    const mensajeAprobacion = document.getElementById('mensajeAprobacion');
    const btnConfirmarAprobacion = document.getElementById('btnConfirmarAprobacion');

    document.querySelectorAll('.btn-aprobar-solicitud').forEach(boton => {
      boton.addEventListener('click', function () {
        const nombre = this.getAttribute('data-nombre');
        const url = this.getAttribute('data-url');

        mensajeAprobacion.innerHTML = `¿Deseas <strong>aprobar</strong> la solicitud del escort <strong>${nombre}</strong>?<br /><br /> Al confirmar la aprobación, el paquete se marcará como comprado y pagado y será asignado automáticamente a <strong>${nombre}</strong>.`;
        btnConfirmarAprobacion.setAttribute('href', url);

        modalAprobacion.show();
      });
    });

    // Modal Rechazar
    const modalRechazo = new bootstrap.Modal(document.getElementById('confirmarRechazoModal'));
    const mensajeRechazo = document.getElementById('mensajeRechazo');
    const btnConfirmarRechazo = document.getElementById('btnConfirmarRechazo');

    document.querySelectorAll('.btn-rechazar-solicitud').forEach(boton => {
      boton.addEventListener('click', function () {
        const nombre = this.getAttribute('data-nombre');
        const url = this.getAttribute('data-url');

        mensajeRechazo.innerHTML = `¿Estás seguro de <strong>rechazar</strong> la solicitud del escort <strong>${nombre}</strong>?`;
        btnConfirmarRechazo.setAttribute('href', url);

        modalRechazo.show();
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
