<div id="sidebar" class="active">
  <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
      <div class="d-flex justify-content-between align-items-center">
        <div class="logo col-7">
          <a href="index.php">
            <img src="./assets/images/logo/intech_horizontal.png" alt="Logo" srcset=""/>
          </a>
        </div>

        <!-- iconos y barra cambio theme -->
        <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
          <svg
            class="iconify iconify--system-uicons"
            width="20"
            height="20"
          >
            <g
              fill="none"
              fill-rule="evenodd"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <g transform="translate(-210 -1)">
                <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                <circle cx="220.5" cy="11.5" r="4"></circle>
                <path
                  d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"
                ></path>
              </g>
            </g>
          </svg>
          <div class="form-check form-switch fs-6">
            <input
              class="form-check-input me-0"
              type="checkbox"
              id="toggle-dark"
              style="cursor: pointer"
            />
            <label class="form-check-label"></label>
          </div>
          <svg
            class="iconify iconify--mdi"
            width="20"
            height="20"
            viewBox="0 0 24 24"
          >
            <path
              fill="currentColor"
              d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"
            ></path>
          </svg>
        </div>
        <!-- termino barra e iconos theme -->

        <div class="sidebar-toggler x">
          <a href="#" class="sidebar-hide d-xl-none d-block">
            <i class="bi bi-x bi-middle"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="sidebar-menu">
      <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <?php
        if($active == 'dashboard'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
          <a href="index.php" class="sidebar-link">
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
          </a>
        </li>

        <?php if (in_array("5", $rol_id) || in_array("1", $rol_id) || in_array("2", $rol_id)):?>

        <?php
        if($active == 'inventario' || $active == 'inv2'){
          echo '<li class="sidebar-item has-sub active">';
        }else{
          echo '<li class="sidebar-item has-sub">';
        }
        ?>
          <a href="inventario.php" class="sidebar-link">
            <i class="bi bi-stack"></i><!-- style="color: rgb(0, 0, 128);" -->
            <span>Inventario</span>
          </a>
          <ul class="submenu">
            <!-- <li class="submenu-item">
              <a href="inventario.php">Actual</a>
            </li> -->
            <li class="submenu-item">
              <a href="inventario.php">Disponible</a>
            </li>
            <li class="submenu-item">
              <a href="#">Por reparar</a>
            </li>
            <li class="submenu-item">
              <a href="#">En reparación</a>
            </li>
          </ul>
        </li>
        <?php endif;?>

        <?php if (in_array("7", $rol_id)||in_array("8", $rol_id)||in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
        <?php
        if($active == 'proximosEventos' || $active == 'crearEventos' || $active === "eventos"){
          echo '<li class="sidebar-item has-sub active">';
        }else{
          echo '<li class="sidebar-item has-sub">';
        }
        ?>
          <a href="#" class="sidebar-link">
            <i class="bi bi-collection-fill"></i>
            <span>Eventos</span>
          </a>
          <ul class="submenu">
            <?php if (in_array("7", $rol_id) ||in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
              <li class="submenu-item">
                <a href="miEvento.php">Crear Evento</a>
              </li>
            <?php endif;?>
            <?php if (in_array("7", $rol_id) ||in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
              <li class="submenu-item">
                <a href="projectPackages.php">Crear paquetes de recursos</a>
              </li>
            <?php endif;?>
            <li class="submenu-item">
              <a href="proyectos.php" >Lista de Eventos</a>
            </li>
            <li class="submenu-item">
              <a href="../eventos.php" >Mis eventos</a>
            </li>
          </ul>
        </li>
        <?php endif;?>
        

        <?php if (in_array("10", $rol_id)):?>
        <?php
        if($active == 'clientes'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
          <a href="/clientes.php" class="sidebar-link">
            <i class="fa-solid fa-handshake"></i>
            <span>Clientes</span>
          </a>
        </li>
        <?php endif;?>

        <?php if (in_array("12", $rol_id)||in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
        <?php
        if($active == 'personal' || $active == 'personal2'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
          <a href="personal.php" class="sidebar-link">
            <i class="fa-solid fa-user"></i>
            <!-- <i class="bi bi-person-check"></i> -->
            <span>Personal</span>
          </a>
        </li>
        <?php endif;?>


        <?php if (in_array("14", $rol_id)||in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
        <?php
        if($active == 'vehiculos'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
          <a href="vehiculos.php" class="sidebar-link">
            <i class="fa-solid fa-truck"></i>
            <!-- <i class="bi bi-person-check"></i> -->
            <span>Vehiculos</span>
          </a>
        </li>
        <?php endif;?>
        

        <?php
        if($active == '1' || $active == '2'){
          echo '<li class="sidebar-item has-sub active">';
        }else{
          echo '<li class="sidebar-item has-sub">';
        }
        ?>
          <!-- <a href="#" class="sidebar-link">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Layouts</span>
          </a>
          <ul class="submenu">
            <li class="submenu-item">
              <a href="layout-default.html">Default Layout</a>
            </li>
            <li class="submenu-item">
              <a href="layout-vertical-1-column.html">1 Column</a>
            </li>
          </ul>
        </li> -->

        <?php if (in_array("1", $rol_id) ||in_array("2", $rol_id)):?>
        <?php
        if($active == 'administracion'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
          <a href="/administracion.php" class="sidebar-link">
            <i class="fa-solid fa-users-gear"></i>
            <!-- <i class="bi bi-person-check"></i> -->
            <span>Administración</span>
          </a>
        </li>
        <?php endif;?>


        <?php if($empresaId === "1"):?>
        <?php
        
        if($active == 'pruebas'){
          echo '<li class="sidebar-item active">';
        }else{
          echo '<li class="sidebar-item">';
        }
        ?>
        
          <a href="/login.php" class="sidebar-link">
            <i class="fa-solid fa-infinity"></i>
            <!-- <i class="bi bi-person-check"></i> -->
            <span>Pruebas</span>
          </a>
        </li>
        <?php endif;?>

      </ul>
    </div>
    <div class="LogOut" >
      <button  class="closeSessionBtn" onclick="closeSession()" >
          <p style="color: #ca2b2b;font-size: 25px;"><i class="fa-solid fa-power-off" ></i> Cerrar Sesión</p>
      </button>
    </div>
  </div>
</div>


<script>
  function closeSession(){
    $.ajax({
      type: "POST",
      url: "ws/Sesion/sesion.php",
      data:JSON.stringify({action:'CloseSession'}),
      dataType: 'json',
      success: async function(response){
        console.log("RESPONSE DE SESSION",response);
        if(response){
          location.reload();
        }
      }
    })
  }
</script>