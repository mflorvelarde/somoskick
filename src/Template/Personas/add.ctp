
     
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
		
		<?= $this->Form->create($persona) ?>
		
                <div class="row">
                    <div class="col-sm-12">
                         <div class="form-group">
                            <?php  echo $this->Form->input('nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                         </div>
                        <div class="form-group">
                            <?php  echo $this->Form->input('apellido',  ['required' => true, 'class' => 'form-control' ] ); ?>
                        </div>
                        <div class="form-group">
                            <?php  echo $this->Form->input('mail',  ['required' => true, 'class' => 'form-control' ] ); ?>
                        </div>                            
                        <div class="form-group">
                            <?php  echo $this->Form->input('dni',  ['required' => true, 'class' => 'form-control' ] ); ?>
                        </div>
                        <div class="form-group">
                            <?php  echo $this->Form->input('telefono',  ['required' => false, 'class' => 'form-control' ] ); ?>
                        </div>
                        <div class="form-group">
                            <?php  echo $this->Form->input('celular',  ['required' => true, 'class' => 'form-control' ] ); ?>
                        </div>
                        <div class="col-md-12" style="padding: 0px">
                            <div class="col-md-2">
                                 <div class="form-group">
                                    <div><label>Perfil</label></div>
                                    <?php  echo $this->Form->select('perfil',
                                    [
                                        'MASTER' => 'MASTER',
                                        'ADMIN' => 'ADMIN',
                                        'VENTAS' => 'VENTAS',
                                        'ATENCION' => 'ATENCION'
                                    ],
                                    [
                                        'required' => true,
                                        'id' => 'perfil',
                                        'style' => 'width: 80%',
                                    ] ); ?>
                                 </div>
                            </div>
                        </div>
                    </div>
                <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-success']) ?>
                <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-primary') ) ?>
                <?= $this->Form->end() ?>
            </div>
            <!-- /.container-fluid -->

