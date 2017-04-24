
<script type="text/javascript">

$( document ).ready(function(){
   $('#pasajeros-table').dynatable();
});
</script>

<section class="content-header">
    <h1>Pasajeros</h1>
    <ol class="breadcrumb">
        <li><a href="../admin/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pasajeros</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Nuevo pasajero'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="pasajeros-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Grupo</th>
                                <th>Contrato</th>
                                <th>Plan de cuotas</th>
                             <!--   <th>Situación</th>
                                <th>Cuenta</th>-->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($pasajerosGrupos as $pasajeroGrupo): ?>
                            <tr>
                                <td><?= h($pasajeroGrupo->pasajero->persona->nombre)?></td>
                                <td><?= h($pasajeroGrupo->pasajero->persona->apellido)?></td>
                                <td><?= h($pasajeroGrupo->pasajero->persona->dni)?></td>
                                <td><?= h($pasajeroGrupo->grupo->nombre)?></td>
                                <td><?= $pasajeroGrupo->contratoaceptado?></td>
                                <td><?= $pasajeroGrupo->planaceptado?></td>
                   <!--             <td><span class="label label-success"><?= h($pasajeroGrupo->cuenta)?></span></td>
                                <td><span class="label label-success"><?= h($pasajeroGrupo->regular)?></span></td> -->
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><?= $this->Form->postLink('Ver pasajero', ['action' => 'verPasajero', $pasajeroGrupo->pasajero->id]) ?></li>
                                            <li><?= $this->Html->link('Editar pasajero', ['action' => 'editarPasajero', $pasajeroGrupo->pasajero->id] ) ?></li>
                                            <li><?= $this->Html->link('Borrar pasajero', ['action' => 'borrarPasajero', $pasajeroGrupo->id] ) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>DNI</th>
                                <th>Grupo</th>
                                <th>Contrato</th>
                                <th>Plan de cuotas</th>
                             <!--   <th>Situación</th>
                                <th>Cuenta</th>-->
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
