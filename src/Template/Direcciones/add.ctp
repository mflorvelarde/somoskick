

	       <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Nuevo Usuario
                        </h1>
                     <ol class="breadcrumb">
			<li>
			    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
			</li>
			<li class="active">
			    <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Personas", "action" => "index"]);?>"> Usuarios </a>
			</li>

			<li class="active">
			    <i class="fa fa-pencil"></i> Nuevo Usuario
			</li>

		    </ol>
                    </div>
                </div>
                <!-- /.row -->

		<?= $this->Form->create($direccion) ?>

                <div class="row">
                    <div class="col-lg-6">
			     <div class="form-group">
                             </div>

<div class="box-body">
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('calle',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('numero',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('piso',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('departamento',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                  <div class="form-group">
                                   <?php  echo $this->Form->input('codigo_postal',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                  <div class="form-group">
                                   <?php  echo $this->Form->input('ciudad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                <div class="form-group">
                                 <?php  echo $this->Form->input('pais',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
		                        <?= $this->Form->button(__('Guardar y continuar'), ['class'=>'btn btn-success']) ?>
                                <?= $this->Html->link(__('Cancelar'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                                <?= $this->Form->end() ?>
                            </div>

                <!-- /.row -->

		<?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
		<?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-primary') ) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.container-fluid -->

