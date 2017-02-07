<section class="content-header">
    <h1 class="page-header">
        Editar viaje
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Viajes", "action" => "index"]);?>"> Viajes </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Editar Viaje  ?>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($viaje) ?>
                    <div class="row">
                        <div class="col-lg-6">
                             <div class="form-group">
                                 <?php  echo $this->Form->input('destino',  ['required' => true, 'class' => 'form-control' ] ); ?>
                             </div>
                             <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-success'] ) ?>
                             <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                             <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

