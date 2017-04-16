<div class='box box-solid'>
    <?php foreach ($notificaciones as $notificacion): ?>
    <div class='box-header with-border'>
        <h3 class='box-title'>Notificación de pago<span class='label label-success'><?= h($notificacion->diccionario->value)?></span></h3>
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
        <?= $this->Html->link(__('Cancelar'), ['action' => 'irCuotas'] , array('class'=>'btn btn-default') ) ?>
    </div>
</div>