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
                            <h5 class="description-header"><?= h($registrados)?> / <span id="pasajeros-estimados"></span></h5>
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
                            <h5 class="description-header"><?= h($pagoPesos)?> / <?= h($totalPesos)?></h5>
                            <span class="description-text">Total pagado ARS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3">
                        <div class="description-block">
                            <h5 class="description-header"><?= h($pagoDolares)?> / <?= h($totalDolares)?></h5>
                            <span class="description-text">Total pagado USD</span>
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
                <table class="table table-hover">
                    <tr>
                        <th></th>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Saldo ARS</th>
                        <th>Precio USD</th>
                        <th>Saldo USD</th>
                        <th>Estado</th>
                        <th>Situación</th>
                        <th>Cuenta</th>
                    </tr>
                    <?php foreach ($regulares as $regular): ?>
                    <tr>
                        <td>1</td>
                        <td><?= h($regular->pasajero->persona->nombre)?> <?= h($regular->pasajero->persona->apellido)?></td>
                        <td>1000</td>
                        <td>500</td>
                        <td>1200</td>
                        <td>200</td>
                        <td>Deudor</td>
                        <td><span class="label label-success">Regular</span></td>
                        <td><span class="label label-success">Activo</span></td>
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
                        <th></th>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Saldo ARS</th>
                        <th>Precio USD</th>
                        <th>Saldo USD</th>
                        <th>Estado</th>
                        <th>Cuenta</th>
                    </tr>
                    <?php foreach ($acompanantes as $acompanante): ?>
                    <tr>
                        <td></td>
                        <td><?= h($acompanante->pasajero->persona->nombre)?> <?= h($acompanante->pasajero->persona->apellido)?></td>
                        <td>1000</td>
                        <td>500</td>
                        <td>1200</td>
                        <td>200</td>
                        <td>Deudor</td>
                        <td><span class="label label-success">Activo</span></td>

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
                        <th></th>
                        <th>Pasajero</th>
                        <th>Precio ARS</th>
                        <th>Saldo ARS</th>
                        <th>Precio USD</th>
                        <th>Saldo USD</th>
                        <th>Estado</th>
                        <th>Situación</th>
                        <th>Cuenta</th>
                    </tr>
                    <?php foreach ($listaEspera as $espera): ?>
                    <tr>
                        <td>1</td>
                        <td><?= h($espera->pasajero->persona->nombre)?> <?= h($espera->pasajero->persona->apellido)?></td>
                        <td>1000</td>
                        <td>500</td>
                        <td>1200</td>
                        <td>200</td>
                        <td>Deudor</td>
                        <td><span class="label label-success">Regular</span></td>
                        <td><span class="label label-success">Activo</span></td>

                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>