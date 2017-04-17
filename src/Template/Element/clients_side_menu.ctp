  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENÚ PRINCIPAL</li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Viajes", "action" => "view"]);?>">
            <i class="fa fa-plane"></i> <span>Mi viaje</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "Previaje", "action" => "info"]);?>">
            <i class="fa fa-suitcase"></i> <span>Información pre viaje</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "CuotasAplicadas", "action" => "index"]);?>">
            <i class="fa fa-th"></i> <span>Pagos</span>
          </a>
        </li>
		<li>
          <a href="<?php echo $this->Url->build(["controller" => "FichasMedicas", "action" => "mifichamedica"]);?>">
            <i class="fa fa-stethoscope"></i> <span>Ficha médica</span>
          </a>
        </li>
<!--		<li>
          <a href="pages/widgets.html">
            <i class="fa fa-file-o"></i> <span>Contrato</span>
          </a>
        </li>
		<li>
          <a href="pages/widgets.html">
            <i class="fa fa-credit-card"></i> <span>Formas de pago</span>
          </a>
        </li>-->
        <li class="header">MI CUENTA</li>
        <li>
          <a href="<?php echo $this->Url->build(["controller" => "Pasajeros", "action" => "miperfil"]);?>">
                <i class="fa fa-circle-o text-aqua"></i> <span>Ver perfil</span></a></li>
        <li>
          <a href="<?php echo $this->Url->build(["action" => "logout"]);?>">
            <i class="fa fa-circle-o text-red"></i> <span>Salir</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>