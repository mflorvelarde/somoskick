
     
	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Vista de Persona
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Personas", "action" => "index"]);?>"> Usuarios </a>
			</li>
			
			<li class="active">
			    <i class="fa fa-eye"></i> Vista Persona <?= h($persona->email) ?>
			</li>
			
		    </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">

                            <div class="form-group">
                                <label>ID: </label> <?= h($persona->id) ?>
                            </div>
                            
                             <div class="form-group">
                                <label>Nombre y Apellido: </label> <?= h($persona->apellido) ?>, <?= h($persona->nombre) ?>
                            </div>
                            
                             <div class="form-group">
                                <label>DNI: </label> <?= h($persona->dni) ?>
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