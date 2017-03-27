
     
	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Vista de Colegios
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>"> Colegios </a>
			</li>
			
			<li class="active">
			    <i class="fa fa-eye"></i> Vista Colegio <?= h($colegio->nombre) ?>
			</li>
			
		    </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">

                            <div class="form-group">
                                <label>ID: </label> <?= h($colegio->id) ?>
                            </div>
                            
                             <div class="form-group">
                                <label>Nombre y Apellido: </label> <?= h($colegio->nombre)?>
                            </div>
                            
                             <div class="form-group">
                                <label>DNI: </label> <?= h($colegio->telefono) ?>
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