
     
	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">                        
                        <h1 class="page-header">
                            Nuevo colegio
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>"> Colegios </a>
			</li>
			
			<li class="active">
			    <i class="fa fa-pencil"></i> Nuevo colegio
			</li>
			
		    </ol>
                    </div>
                </div>
                <!-- /.row -->
		
		<?= $this->Form->create($colegio) ?>
		
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <div class="input text required">
                            <input type="text" name="nombre" required="required" class="form-control" id="nombre">
                        </div>
                    </div>

                    <div class="form-group">
                        <?php  echo $this->Form->input('telefono',  ['required' => true, 'class' => 'form-control' ] ); ?>
                    </div>

                    <div class="form-group">
                        <?php  echo $this->Form->input('comentarios',  ['required' => true, 'class' => 'form-control' ] ); ?>
                    </div>

                    <div class="form-group">
                        <?php  echo $this->Form->input('contacto',  ['required' => true, 'class' => 'form-control' ] ); ?>
                    </div>

                </div>


                <!-- /.row -->

                    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
                    <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-primary') ) ?>
                    <?= $this->Form->end() ?>
            </div>
            <!-- /.container-fluid -->

