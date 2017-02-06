
                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">
                            Edici&oacute;n de Camadas
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Camadas", "action" => "index"]);?>"> Camadas </a>
                            </li>

                            <li class="active">
                                <i class="fa fa-pencil"></i> Edici&oacute;n camada ?>
                            </li>

            		    </ol>
                    </div>
                </div>

		<?= $this->Form->create($camada) ?>
<div class="row">
    <div class="col-lg-6">
        <div class="form-group">
            <?php  echo $this->Form->input('descripcion',  ['required' => true, 'class' => 'form-control' ] ); ?>
        </div>

        <div class="form-group">
            <?php  echo $this->Form->input('año',  ['required' => true, 'class' => 'form-control' ] ); ?>
        </div>

        <div class="form-group">
            <?php  echo $this->Form->input('contacto1',  ['required' => true, 'class' => 'form-control' ] ); ?>
        </div>

        <div class="form-group">
            <?php  echo $this->Form->input('contacto2',  ['required' => true, 'class' => 'form-control' ] ); ?>
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
