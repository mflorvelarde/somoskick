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
            <dt>Pasajero</dt>
            <dd><?= h($notificacion->cuotas_aplicada->pasajerosdegrupo->pasajero->persona->apellido)?>, <?= h($notificacion->cuotas_aplicada->pasajerosdegrupo->pasajero->persona->nombre)?></dd>
            <dt>Grupo</dt>
            <dd><?= h($notificacion->cuotas_aplicada->pasajerosdegrupo->grupo->nombre)?></dd>
            <dt>Monto de cuota</dt>
            <dd><?= h($notificacion->cuotas_aplicada->cuota->moneda)?><?= h($notificacion->cuotas_aplicada->cuota->monto)?></dd>
            <dt>Monto abonado</dt>
            <dd><?= h($notificacion->moneda)?><?= h($notificacion->monto)?></dd>
            <dt>Fecha de pago</dt>
            <dd><?= h($notificacion->fecha_pago)?></dd>
            <dt>CUIT / CUIL</dt>
            <dd><?= h($notificacion->cuit_cuil)?></dd>
            <dt>Medio de pago</dt>
            <dd><?= h($notificacion->medio_pago)?></dd>
            <?php if(strcmp($notificacion->medio_pago, "transferencia") == 0) {?>
            <dt>Número de comprobante</dt>
            <?php } else { ?>
            <dd><?= h($notificacion->numero_comprobante)?></dd>
            <dt>Número de transacción</dt>
            <dd><?= h($notificacion->numero_transaccion)?></dd>
            <dt>Número de sobre</dt>
            <dd><?= h($notificacion->numero_sobre)?></dd>
            <?php } ?>
            <dt>Banco</dt>
            <dd><?= h($notificacion->banco)?></dd>
            <dt>Sucursal</dt>
            <dd><?= h($notificacion->sucursal)?></dd>
        </dl>
    </div>
    <?php endforeach; ?>
</div>
</div>
</div>
</div>
</section>