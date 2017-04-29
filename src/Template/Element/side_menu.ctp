 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ PRINCIPAL</li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>">
            <i class="fa fa-building-o"></i> <span>Colegios</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Camadas", "action" => "index"]);?>">
            <i class="fa fa-graduation-cap"></i> <span>Camadas</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Pasajerosdegrupos", "action" => "index"]);?>">
            <i class="fa fa-users"></i> <span>Pasajeros</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "NotificacionesPagos", "action" => "index"]);?>">
            <i class="fa fa-credit-card"></i> <span>Notifiaciones de pago</span>
          </a>
        </li>
        <li>
          <a href="<?php echo $this->Url->build(["controller" => "Tarifas", "action" => "index"]);?>">
            <i class="fa fa-bookmark-o"></i> <span>Tarifas</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Viajes", "action" => "index"]);?>">
            <i class="fa fa-plane"></i> <span>Destinos</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Dolares", "action" => "index"]);?>">
            <i class="fa fa-money"></i> <span>Cotización dolar</span>
          </a>
        </li>
		<li class="header">MI CUENTA</li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Ver perfil</span></a></li>
        <li>
          <a href="<?php echo $this->Url->build(["action" => "logout"]);?>">
            <i class="fa fa-circle-o text-red"></i> <span>Salir</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>



