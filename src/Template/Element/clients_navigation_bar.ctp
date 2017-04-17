<a class="logo" href="<?php echo $this->Url->build(["controller" => "Home", "action" => "clientes"]);?>">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">Kick</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Kick</b> Clientes</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu" style="width:150px">
        <ul class="nav navbar-nav" style="width:150px">
        <li class="dropdown notifications-menu" style="width:150px">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="text-align:right">
                  <span class="hidden-xs"><?php  echo $this->request->session()->read('Auth.User.nombre'); ?> <?php echo $this->request->session()->read('Auth.User.apellido'); ?></span>
                      <i class="fa fa-user"></i>
                    </a>
        </li>
        </ul>
        </div>
</nav>