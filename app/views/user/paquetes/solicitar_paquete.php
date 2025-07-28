<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
//print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Solicitud de Paquetes</title><!--begin::Accessibility Meta Tags-->
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

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <link rel="preload" href="public/adminlte/css/adminlte.css" as="style"><!--end::Accessibility Features--><!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'"><!--end::Fonts--><!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous">
  <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous"><!--end::Third Party Plugin(Bootstrap Icons)--><!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/adminlte/css/adminlte.css"><!--end::Required Plugin(AdminLTE)-->
   <link rel="stylesheet" href="<?php echo BASE_URL; ?>public/adminlte/css/style.css"><!--end::Required Plugin(AdminLTE)-->
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary"> <!--begin::App Wrapper-->
  <div class="app-wrapper"> <!--begin::Header-->
<!--aqui val el Header*-*-*-*-*-*-*-*-*-*--->
<?php include "app/views/user/includes/header.php" ?>
<!--aqui val el SIDEBAR*-*-*-*-*-*-*-*-*-*--->
<?php include "app/views/user/includes/sidebar.php" ?>
     <!--begin::App Main-->
     <main class="app-main">
      <section class="content header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Solicitud de Paquetes</h1>
            </div>
          </div>
        </div>
      </section>

      

      <section class="content">
        <div class="container-fluid">
           <?php //print_r($escorts); ?>
          <form action="<?php echo BASE_URL; ?>user/paquetes/enviar_solicitud" method="POST">



              <div class="mb-3">
                <label for="escort_id">Selecciona Escort:</label>
                <select name="escort_id" id="escort_id" class="form-control" required>
                <?php foreach ($escorts as $escort): ?>
                        <option value="<?= $escort['ID'] ?>"><?= htmlspecialchars($escort['Nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
              </div>              

              <div class="mb-3">
                <label for="paquete_id">Selecciona Paquete:</label>
                <select name="paquete_id" id="paquete_id" class="form-control" required>
                      <option value="">---</option>
                  <?php foreach ($paquetes as $paquete): ?>
                      <option value="<?= $paquete['id'] ?>"><?= htmlspecialchars($paquete['nombre']) ?></option>
                  <?php endforeach; ?>
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

              <div class="mb-3">
                <label for="descripcion">Descripción del Paquete:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="5" cols="50"></textarea>
              </div> 

                    <input type="hidden" name="usuario_id" value="<?php echo $escort['usuario_id'] ?>">
              <button type="submit" class="btn btn-success btn-sm">Enviar solicitud</button>
          </form>

        </div>
      </section>
    </main>
   <!--AQUI VA EL::FOOTER*-*-*-*-*-*-*--->
   <?php include "app/views/user/includes/footer.php" ?>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

  <!-- Bootstrap 5 Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

  <!-- AdminLTE 4 -->
  <script src="<?php echo BASE_URL; ?>public/adminlte/js/adminlte.js"></script>



</body><!--end::Body-->

</html>