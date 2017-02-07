<section class="content-header">
    <h1 class="page-header">
        Editar colegio
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>"> Colegios </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Editar Colegio
        </li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($colegio) ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <?php  echo $this->Form->input('nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
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
                            <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-success'] ) ?>
                            <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>