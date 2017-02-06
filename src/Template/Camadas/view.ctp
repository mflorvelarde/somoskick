
     
	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Vista de Camada
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Camadas", "action" => "index"]);?>"> Camadas </a>
			</li>
			
			<li class="active">
			    <i class="fa fa-eye"></i> Vista Camada ?>
			</li>
			
		    </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">

                            <div class="form-group">
                                <label>Descripción: </label> <?= h($camada->descripcion) ?>
                            </div>
                            
                             <div class="form-group">
                                <label>Año: </label> <?= h($camada->año)?>
                            </div>
                            
                             <div class="form-group">
                                <label>Contacto: </label> <?= h($camada->contacto1) ?>
                            </div>

                             <div class="form-group">
                                <label>Contacto: </label> <?= h($camada->contacto2) ?>
                            </div>

                    </div>
                    
                 
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->