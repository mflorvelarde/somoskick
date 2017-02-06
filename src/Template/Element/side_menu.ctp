            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">

                    <ul class="nav" id="side-menu">

                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <!-- ************************** -->

                        <li>
			     <a href="#"><i class="fa fa-wrench fa-fw"></i>Administraci&oacute;n <span class="fa arrow"></span></a>

			     <ul class="nav nav-second-level">
			     <li>
                                <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]);?>">
				    Usuarios
                                </a>
			      </li>
			      <li>
                                <a href="#">
				   Perfiles
                                </a>
			      </li>
			      <li>
                                <a href="#">
				  Configuraci&oacute;n
                                </a>
			      </li>
			  </ul>
                            <!-- /.nav-second-level -->
                        </li>


			<!-- ************************** -->

			<li>
			     <a href="#"><i class="fa fa-user"></i> Gesti&oacute;n de Clientes <span class="fa arrow"></span></a>

			     <ul class="nav nav-second-level">
				<li>
				    <a href="<?php echo $this->Url->build(["controller" => "Productos", "action" => "index"]);?>">
				      <i class="fa fa-th"></i>
					Gesti&oacute;n Productos
				    </a>
				</li>
			    </ul>
                            <!-- /.nav-second-level -->
                        </li>

			<!-- ************************** -->

			<li>
			     <a href="#"><i class="fa fa-user"></i>  Mi Autogesti&oacute;n  <span class="fa arrow"></span></a>

			     <ul class="nav nav-second-level">
				<li>
				   <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "index"]);?>">
				    <i class="fa fa-th-large"></i>
				      Mis Productos
				  </a>
				</li>
			    </ul>
                            <!-- /.nav-second-level -->
                        </li>

			<!-- ************************** -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->

