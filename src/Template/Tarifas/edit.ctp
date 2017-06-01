<section class="content-header">
    <h1 class="page-header">
        Editar tarifa
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Tarifas", "action" => "index"]);?>"> Tarifas </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Nueva tarifa
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
		            <?= $this->Form->create($tarifa) ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <div class="input text required">
                                    <?php  echo $this->Form->input('descripcion',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo $this->Form->input('viaje_id', ['options' => $viajes_options]); ?>
                            </div>
                            <div class="form-group">
                                <?php  echo $this->Form->input('monto_pesos',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>

                            <div class="form-group">
                                <?php  echo $this->Form->input('monto_dolares',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>
                            <div class="form-group">
                                <?php  echo $this->Form->input('cantidad_cuotas',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>
                            <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                            <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
