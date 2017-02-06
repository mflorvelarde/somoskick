<div id="page-wrapper">
            <div class="container-fluid">
     
	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Edici&oacute;n de viajes
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Viajes", "action" => "index"]);?>"> Viajes </a>
			</li>
			
			<li class="active">
			    <i class="fa fa-pencil"></i> Edici&oacute;n Viaje  ?>
			</li>
			
		    </ol>
                    </div>
                </div>
                <!-- /.row -->
		
		<?= $this->Form->create($viaje) ?>
		<div class="row">
            <div class="col-lg-6">
			     <div class="form-group">
    				 <?php  echo $this->Form->input('destino',  ['required' => true, 'class' => 'form-control' ] ); ?>
                 </div>
            </div>
        </div>
                
                <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-success'] ) ?>
                <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-primary') ) ?>
		        <?= $this->Form->end() ?>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
