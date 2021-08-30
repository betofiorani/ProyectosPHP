<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="../build/img/logo.svg" alt="GDLWEBCAMP Logo" class="brand-image elevation-3" style="opacity: .8">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../build/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a class="d-block">Beto Fiorani</a>
          <a class= "cerrar-sesion" href="/login?cerrar-sesion=true">Cerrar Sesion</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tablero de Control</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Eventos
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/evento/listar" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/evento/crear" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Evento</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Categoría Eventos
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/categoria/listar" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/categoria/crear" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Categoría</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user-circle"></i>
              <p>
                Invitados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/invitado/listar" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/invitado/crear" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Invitado</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-address-card"></i>
              <p>
                Registrados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/registrado/listar" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/registrado/crear" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Registrado</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-comments"></i>
              <p>
                Testimoniales
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Testimonial</p>
                </a>
              </li>
            </ul>
          </li>
          <?php 
            if($_SESSION['nivel'] === '1'):
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Administradores
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/listar" class="nav-link">
                  <i class="fa fa-list-ul nav-icon"></i>
                  <p>Ver Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/crear" class="nav-link">
                  <i class="fa fa-plus-circle nav-icon"></i>
                  <p>Agregar Administrador</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
