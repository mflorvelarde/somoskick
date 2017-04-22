<section class="content-header">
    <h1 class="page-header">
        Notificaciones
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "CuotasAplicadas", "action" => "index"]);?>"> Cuotas </a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Notificaciones
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
<div class='box box-solid'>
    <?php foreach ($notificaciones as $notificacion): ?>
    <div class='box-header with-border'>
        <h3 class='box-title'>Notificación de pago<span class='label label-info'><?= h($notificacion->diccionario->value)?></span></h3>
    </div>
    <div class='box-body'>
        <dl class='dl-horizontal'>
            <dt>Cuota</dt>
            <dd><?= h($notificacion->cuota_aplicada_id)?></dd>
            <dt>Medio de pago</dt>
            <dd><?= h($notificacion->medio_pago)?></dd>
            <dt>Monto</dt>
            <dd><?= h($notificacion->moneda)?><?= h($notificacion->monto)?></dd>
            <dt>Fecha de pago</dt>
            <dd><?= h($notificacion->fecha_pago)?></dd>
        </dl>
    </div>
    <?php endforeach; ?>
    <div class='box-footer'>
        <?= $this->Html->link(__('Volver'), ['action' => 'irCuotas'] , array('class'=>'btn btn-default') ) ?>
    </div>
</div>
</div>
</div>
</div>
</section>