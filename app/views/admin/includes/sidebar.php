<?php
include APP_ROOT . '/app/core/globales.inc.php';
//print_r(BASE_URL);
?>
 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
      <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="../index.html" class="brand-link">
          <!--begin::Brand Image--> <img src="<?php echo BASE_URL; ?>public/adminlte/assets/img/AdminLTELogo.png" alt="Reinovip Logo"
            class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
            class="brand-text fw-light">Reinovip</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
      <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
      <div class="sidebar-wrapper">
        <nav class="mt-2"> <!--begin::Sidebar Menu-->
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
            aria-label="Main navigation" data-accordion="false" id="navigation">
            <li class="nav-item"> <a href="/dashboard" class="nav-link"> <i class="nav-icon bi bi-speedometer"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item"> <a href="<?php echo BASE_URL; ?>admin/usuarios" class="nav-link"> <i class="nav-icon bi bi-circle text-danger"></i>
                <p class="text">Usuarios</p>
              </a> </li>
            <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle text-warning"></i>
                <p>Gestion de Paquetes</p>
              </a> 
               <ul class="nav nav-treeview">
                <li class="nav-item"> <a href="<?php echo BASE_URL; ?>admin/paquetes" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                    <p>Paquetes</p>
                  </a> </li>
                <li class="nav-item"> <a href="<?php echo BASE_URL; ?>paquetes/listar_opciones" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                    <p>Opciones de Paquetes</p>
                  </a> </li>
                  <li class="nav-item"> <a href="<?php echo BASE_URL; ?>paquetes/listar_solicitudes" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                    <p>Solicitudes de Paquetes</p>
                  </a> </li>

              </ul>
            </li>
            <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-circle text-info"></i>
                <p>Informational</p>
              </a> </li>
          </ul> <!--end::Sidebar Menu-->
        </nav>
      </div> <!--end::Sidebar Wrapper-->
    </aside> <!--end::Sidebar-->