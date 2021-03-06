<!-- Sidebar -->
<div class="sidebar">
  <!-- Sidebar user (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
      <img src="https://www.tuexperto.com/wp-content/uploads/2015/07/perfil_01.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
      <p style="color: white">Carlos Veracruz</p>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      {{-- <!-- Add icons to the links using the .nav-icon class --}}
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-adjust"></i>
            <p>
              Elementos
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href={{ action('ProductoController@listado') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Productos</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a href="/car_wash/catalogos/servicios/listado" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Servicios</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a href={{ action('PersonalController@listado') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Personal</p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{ action('TiposervicioController@listado') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tipos de servicios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{ action('SocioController@listado') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Socios</p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{ action('TiporolController@listado') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{ action('DemoController@prueba_vue') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Calendario</p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{ action('PagoController@ventanilla') }} class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Realizar Pago</p>
              </a>
            </li>
          </ul>
          <li class="nav-item">
            <a href={{ action('BuscadorController@index') }} class="nav-link">
              <i class="fas fa-search"></i>
              <p>Buscador</p>
            </a>
          </li>
        </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>