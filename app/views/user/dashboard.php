<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Administracion Usuario</title><!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <!-- <meta name="color-scheme" content="light dark">
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)"> -->
  <!--end::Accessibility Meta Tags--><!--begin::Primary Meta Tags-->
  <meta name="title" content="Layout | AdminLTE 4">
  <meta name="author" content="ColorlibHQ">
  <meta name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance.">
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant">
  <!--end::Primary Meta Tags--><!--begin::Accessibility Features--><!-- Skip links will be dynamically added by accessibility.js -->
  <meta name="supported-color-schemes" content="light dark">
  <link rel="preload" href="public/adminlte/css/adminlte.css" as="style"><!--end::Accessibility Features--><!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous">
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="public/adminlte/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
   <link rel="stylesheet" href="public/adminlte/css/style.css"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary"> <!--begin::App Wrapper-->
  <div class="app-wrapper"> <!--begin::Header-->
<!--aqui val el Header*-*-*-*-*-*-*-*-*-*--->
<?php include "includes/header.php" ?>
<!--aqui val el SIDEBAR*-*-*-*-*-*-*-*-*-*--->
<?php include "includes/sidebar.php" ?>
     <!--begin::App Main-->
    <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Bienvenido Usuario</h1>
            </div>
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
      <?php if (Session::estaImpersonando()): ?>
          <div class="alert alert-info">
              <strong>Modo Impersonación:</strong> Estás visualizando como otro usuario.
              <a href="index.php?r=salir_impersonacion" class="btn btn-sm btn-danger">Volver a modo administrador</a>
          </div>
      <?php endif; ?>

          <h4>Paquete Activo</h4>
          <?php if ($paqueteActivo): ?>
              <div class="alert alert-success">
                  <strong><?= $paqueteActivo['nombre'] ?></strong><br>
                  Válido hasta: <?= $paqueteActivo['fecha_fin'] ?>
              </div>
          <?php else: ?>
              <div class="alert alert-warning">No tienes un paquete activo.</div>
          <?php endif; ?>

          <h4>Historial de Paquetes</h4>
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
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">

          <h4>Paquetes Disponibles para Comprar</h4>
          <div class="row g-4 mb-4">
              <?php foreach($paquetes as $p): ?>
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-header"><?= $p['nombre'] ?></div>
                        <div class="card-body">
                            <p><?= $p['descripcion'] ?></p>
                            <p><strong>$<?= $p['precio'] ?></strong></p>
                            <p><?= $p['cantidad_publicaciones'] ?> publicaciones</p>
                            <p>Duración: <?= $p['duracion_dias'] ?> días</p>
                            <a href="#" 
                            class="btn btn-success btn-comprar-paquete" 
                            data-nombre="<?= htmlspecialchars($p['nombre']) ?>" 
                            data-url="/user/comprar_paquete?id=<?= $p['id'] ?>">
                            Comprar
                          </a>
                        </div>
                    </div>
                </div>
              <?php endforeach; ?>
          </div>
        </div>
      </section>

    <!-- Modal Confirmación Compra -->
    <div class="modal fade" id="confirmarCompraModal" tabindex="-1" aria-labelledby="confirmarCompraLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="confirmarCompraLabel">Confirmar Compra</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
          </div>

          <div class="modal-body">
            <p id="mensajeConfirmacion">¿Deseas confirmar la compra del paquete?</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <a href="#" class="btn btn-success" id="btnConfirmarCompra">Confirmar</a>
          </div>

        </div>
      </div>
    </div>

    </main>
   <!--AQUI VA EL::FOOTER*-*-*-*-*-*-*--->
   <?php include "includes/footer.php" ?>
  </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
  <script src="public/adminlte/js/adminlte.js"></script>
  <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
<script>
document.addEventListener('DOMContentLoaded', () => {

  const modal = new bootstrap.Modal(document.getElementById('confirmarCompraModal'));
  const mensaje = document.getElementById('mensajeConfirmacion');
  const btnConfirmar = document.getElementById('btnConfirmarCompra');

  document.querySelectorAll('.btn-comprar-paquete').forEach(boton => {
    boton.addEventListener('click', function(e) {
      e.preventDefault();

      const nombre = this.getAttribute('data-nombre');
      const url = this.getAttribute('data-url');

      mensaje.textContent = `¿Estás seguro de que deseas comprar el paquete "${nombre}"?`;
      btnConfirmar.setAttribute('href', url);

      modal.show();
    });
  });

});
</script>

</body><!--end::Body-->

</html>