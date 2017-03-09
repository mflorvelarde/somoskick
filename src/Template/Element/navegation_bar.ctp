<a href="../admin/index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">Kick</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Kick</b> Admins</span>
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
                    <ul class="dropdown-menu" style="width:150px">
                      <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                          <li>
                               <?= $this->Html->link(__('Ver perfil'), ['action' => 'logout'] , ['style' => 'text-align:right' ]) ?>
                          </li>
                          <li>
                               <?= $this->Html->link(__('Salir'), ['action' => 'logout'] , ['style' => 'text-align:right' ]) ?>
                          </li>
                    </ul>
        </li>
    </div>
</nav>