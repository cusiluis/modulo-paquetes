<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
<nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
      <div class="container-fluid"> <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                class="bi bi-list" style="color: #3b67f5;font-size: 1.5rem;font-weight: 700 !important;"></i> </a> </li>
        </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
       
          <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
              data-bs-toggle="dropdown"> <img src="<?php echo BASE_URL; ?>public/adminlte/assets/img/user2-160x160.jpg"
                class="user-image rounded-circle shadow" alt="User Image"> <span class="d-none d-md-inline"><?php print_r($escorts[0]["Nombre"]); ?>Alexander
                Pierce</span> </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
              <li class="user-header text-bg-primary"> <img src="<?php echo BASE_URL; ?>public/adminlte/assets/img/user2-160x160.jpg"
                  class="rounded-circle shadow" alt="User Image">
                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2023</small>
                </p>
              </li> <!--end::User Image--> <!--begin::Menu Body-->
              <li class="user-footer"> <a href="#" class="btn btn-primary">Perfil</a> <a href="<?php echo BASE_URL; ?>logout"
                  class="btn btn-danger float-end">Cerrar sesion</a> </li> <!--end::Menu Footer-->
            </ul>
          </li> <!--end::User Menu Dropdown-->
        </ul> <!--end::End Navbar Links-->
      </div> <!--end::Container-->
    </nav> <!--end::Header--> <!--begin::Sidebar-->