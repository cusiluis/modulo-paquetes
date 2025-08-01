<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
<!DOCTYPE html>
<html> <!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>AdminLTE 4 | Login Page v2</title><!--begin::Accessibility Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <meta name="color-scheme" content="light dark">
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)">
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)">
  <!--end::Accessibility Meta Tags--><!--begin::Primary Meta Tags-->
  <meta name="title" content="AdminLTE 4 | Login Page v2">
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
</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header"> <a href="../index2.html"
          class="link-dark text-center link-offset-2 link-opacity-100 link-opacity-50-hover">
          <h1 class="mb-0"> <img src="public/adminlte/images/logo-reino-vip.png" alt="Reinovip Logo"/>
          </h1>
        </a> </div>
      <div class="card-body login-card-body">
        <p class="login-box-msg">Inicia sesión para comenzar tu sesión</p>
        <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST" action="<?php echo BASE_URL; ?>login_post">
          <div class="input-group mb-1">
            <div class="form-floating"> <input id="loginEmail" type="email"  name="email" class="form-control" value=""
                placeholder="" required> <label for="loginEmail">Correo</label> </div>
            <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
          </div>
          <div class="input-group mb-1">
            <div class="form-floating"> <input id="loginPassword" type="password" name="password" class="form-control" placeholder="" required>
              <label for="loginPassword">Contraseña</label> </div>
            <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
          </div> <!--begin::Row-->
          <div class="row">
            <div class="col d-inline-flex align-items-center">
            <div class="col-8">
              <div class="d-grid gap-2"> <button type="submit" class="btn submit-btn">Ingresar</button> </div>
            </div> <!-- /.col -->
          </div> <!--end::Row-->
        </form>
      </div> <!-- /.login-card-body -->
    </div>
  </div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
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
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper"
    const Default = {
      scrollbarTheme: "os-theme-light",
      scrollbarAutoHide: "leave",
      scrollbarClickScroll: true
    }
    document.addEventListener("DOMContentLoaded", function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER)
      if (
        sidebarWrapper &&
        OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined
      ) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll
          }
        })
      }
    })
  </script> <!--end::OverlayScrollbars Configure--><!-- Image path runtime fix -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Find the link tag for the main AdminLTE CSS file.
      const cssLink = document.querySelector('link[href*="css/adminlte.css"]');
      if (!cssLink) {
        return; // Exit if the link isn't found
      }

      // Extract the base path from the CSS href.
      // e.g., from "../css/adminlte.css", we get "../"
      // e.g., from "./css/adminlte.css", we get "./"
      const cssHref = cssLink.getAttribute('href');
      const deploymentPath = cssHref.slice(0, cssHref.indexOf('css/adminlte.css'));

      // Find all images with absolute paths and fix them.
      document.querySelectorAll('img[src^="/assets/"]').forEach(img => {
        const originalSrc = img.getAttribute('src');
        if (originalSrc) {
          const relativeSrc = originalSrc.slice(1); // Remove leading '/'
          img.src = deploymentPath + relativeSrc;
        }
      });
    });
  </script> <!--end::Script-->
</body><!--end::Body-->

</html>