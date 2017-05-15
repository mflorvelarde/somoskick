<script type="text/javascript">
    $( document ).ready(function(){
       $('#notificaciones-table').dynatable();
    });
</script>

<section class="content-header">
	<h1 class="page-header">Notificaciones de pago</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">Notificaciones</li>
	</ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Ver pendientes'), ['action' => 'pendientes'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="notificaciones-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Pasajero</th>
                                <th>Monto ARS de cuota</th>
                                <th>Monto ARS abonado</th>
                                <th>Monto U$S de cuota</th>
                                <th>Monto U$S abonado</th>
                                <th>Vencimiento de cuota</th>
                                <th>Fecha de pago</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php foreach ($notificaciones as $notificacion): ?>
                        <tbody>
                        <tr>
                            <td><?= $notificacion->cuotas_aplicada->pasajerosdegrupo->pasajero->persona->nombre?>  <?= $notificacion->cuotas_aplicada->pasajerosdegrupo->pasajero->persona->apellido?></td>
                            <td><?= $notificacion->cuotas_aplicada->cuota->monto_pesos ?></td>
                            <td><?= $notificacion->monto_pesos ?></td>
                            <td><?= $notificacion->cuotas_aplicada->cuota->monto_dolares ?></td>
                            <td><?= $notificacion->monto_dolares ?></td>
                            <td><?= $notificacion->cuotas_aplicada->cuota->vencimiento ?></td>
                            <td><?= $notificacion->fecha_pago ?></td>
                            <td><?= $notificacion->statusNotif ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><?= $this->Form->postLink('Ver', ['action' => 'view', $notificacion->id]) ?></li>
                                        <li><?= $this->Form->postLink('Acreditar', ['action' => 'acreditar', $notificacion->id, 'pendientes']) ?></li>
                                        <li><?= $this->Html->link('Rechazar', ['action' => 'rechazar', $notificacion->id, 'pendientes'] ) ?></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Pasajero</th>
                                <th>Monto ARS de cuota</th>
                                <th>Monto ARS abonado</th>
                                <th>Monto U$S de cuota</th>
                                <th>Monto U$S abonado</th>
                                <th>Vencimiento</th>
                                <th>Fecha de pago</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
