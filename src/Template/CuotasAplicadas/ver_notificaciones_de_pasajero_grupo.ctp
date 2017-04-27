<div class="row">
    <div class="col-md-12">
        <div id="form-carga-notificaciones" class="box box-info hidden-element"></div>
            <div class="row">
                <div id="notif" class="col-xs-12 hidden-element"></div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cuotas</h3>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Monto pesos</th>
                            <th>Monto dólares</th>
                            <th>Vencimiento (MES DÍA AÑO)</th>
                            <th>Status de pago</th>
                            <th>Status notificación</th>
                            <th>Acciones</th>
                        </tr>
                        <?php foreach ($cuotas as $cuotaAplicada): ?>
                        <tr>
                            <td><?= h($cuotaAplicada->cuota->monto_pesos)?></td>
                            <td><?= h($cuotaAplicada->cuota->monto_colares)?></td>
                            <td><?= h($cuotaAplicada->cuota->vencimiento)?></td>
                            <td><?= $cuotaAplicada->status?></td>
                            <td><?= $cuotaAplicada->statusNotif?></td>
                            <td>
                                <?php if ($cuotaAplicada->tieneNotificaciones) {?>
                                <?= $this->Html->link(__('Ver notificaciones'), ['controller' => 'NotificacionesPagos', 'action' => 'verNotificacionesPasajero', $cuotaAplicada->id] , array('class'=>'btn btn-block btn-warning margin-bottom btn-xs') ) ?>
                                <?php }?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
