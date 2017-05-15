    <style>
        #dynatable-pagination-links-table_senat{
            display:none;
        }
    </style>

<script type="text/javascript">

$( document ).ready(function(){
   $('#pasajeros-table').dynatable();
   $('#pasajeros-table').paginationPerPage.set(20);
});
</script>


<div class="row">
    <div class="col-xs-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
        <div class="box box-widget widget-user">
            <div class="widget-user-header bg-maroon-active" style="height: 55px">
                <h3 class="widget-user-username" id="nombre-grupo"></h3>
            </div>
        </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-2 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($registrados)?> / <?= h($pasajeros_estimados)?></span></h5>
                            <span class="description-text">Usuarios registrados</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-2 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($hombres)?></h5>
                            <span class="description-text">Hombres</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-2 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($mujeres)?></h5>
                            <span class="description-text">Mujeres</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($totalPesos)?></h5>
                            <span class="description-text">Total ARS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($totalDolares)?></h5>
                            <span class="description-text">Total USD</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Pasajeros Activos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table id="pasajeros-table" class="table table-hover">
                    <tr>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Precio USD</th>
                        <th>Contrato</th>
                        <th>Plan de cuotas</th>
                        <th></th>
                    </tr>
                    <?php foreach ($regulares as $regular): ?>
                    <tr>
                        <td><?= h($regular->pasajero->persona->nombre)?> <?= h($regular->pasajero->persona->apellido)?></td>
                        <td><?= h($regular->tarifas_aplicada->tarifa->monto_pesos)?></td>
                        <td><?= h($regular->tarifas_aplicada->tarifa->monto_dolares)?></td>
                        <td><?= $regular->contratoaceptado?></td>
                        <td><?= $regular->planaceptado?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?= $this->Form->postLink('Ver pasajero', ['action' => 'verPasajero', $regular->pasajero->id]) ?></li>
                                    <li><?= $this->Html->link('Editar pasajero', ['action' => 'editarPasajero', $regular->pasajero->id] ) ?></li>
                                    <li><?= $this->Html->link('Borrar pasajero', ['action' => 'borrarPasajero', $regular->id] ) ?></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Acompañantes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Precio USD</th>
                        <th>Contrato</th>
                        <th>Plan de cuotas</th>
                        <th></th>
                    </tr>
                    <?php foreach ($acompanantes as $acompanante): ?>
                    <tr>
                        <td><?= h($acompanante->pasajero->persona->nombre)?> <?= h($regular->pasajero->persona->apellido)?></td>
                        <td><?= h($acompanante->tarifas_aplicada->tarifa->monto_pesos)?></td>
                        <td><?= h($acompanante->tarifas_aplicada->tarifa->monto_dolares)?></td>
                        <td><?= $acompanante->contratoaceptado?></td>
                        <td><?= $acompanante->planaceptado?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?= $this->Form->postLink('Ver pasajero', ['action' => 'verPasajero', $acompanante->pasajero->id]) ?></li>
                                    <li><?= $this->Html->link('Editar pasajero', ['action' => 'editarPasajero', $acompanante->pasajero->id] ) ?></li>
                                    <li><?= $this->Html->link('Borrar pasajero', ['action' => 'borrarPasajero', $acompanante->id] ) ?></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Lista de espera</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Precio USD</th>
                        <th>Contrato</th>
                        <th>Plan de cuotas</th>
                        <th></th>
                    </tr>
                    <?php foreach ($listaEspera as $espera): ?>
                    <tr>
                        <td><?= h($espera->pasajero->persona->nombre)?> <?= h($regular->pasajero->persona->apellido)?></td>
                        <td><?= h($espera->tarifas_aplicada->tarifa->monto_pesos)?></td>
                        <td><?= h($espera->tarifas_aplicada->tarifa->monto_dolares)?></td>
                        <td><?= $espera->contratoaceptado?></td>
                        <td><?= $espera->planaceptado?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><?= $this->Form->postLink('Ver pasajero', ['action' => 'verPasajero', $espera->pasajero->id]) ?></li>
                                    <li><?= $this->Html->link('Editar pasajero', ['action' => 'editarPasajero', $espera->pasajero->id] ) ?></li>
                                    <li><?= $this->Html->link('Borrar pasajero', ['action' => 'borrarPasajero', $espera->id] ) ?></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>