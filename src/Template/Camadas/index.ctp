<section class="content-header">
    <h1>Camadas</h1>
    <ol class="breadcrumb">
        <li><a href="../admin/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Camadas</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Nueva camada'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Colegio</th>
                                <th>Camada</th>
                                <th>Vendedor</th>
                                <th>Estado</th>
                                <th>En lista de espera</th>
                                <th>Regulares</th>
                                <th>Registrados</th>
                                <th>Por contrato</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($camadas as $camada): ?>
                            <tr>
                                <td><?= h($camada->colegio->nombre)?></td>
                                <td><?= h($camada->año)?></td>
                                <td><?= h($camada->persona->nombre)?></td>
                                <td><span class="label label-success"><?= h($camada->diccionario->value)?></span></td>
                                <td>No</td>
                                <td>18</td>
                                <td>18</td>
                                <td><?= h($camada->grupo->pasajeros_estimados)?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><?= $this->Form->postLink('Ver camadas', ['action' => 'view', $camada->id]) ?></li>
                                            <li><?= $this->Html->link('Cambiar status', ['action' => 'edit', $camada->id] ) ?></li>
                                            <li><?= $this->Html->link('Aplicar tarifa', ['action' => 'buscartarifas', $camada->id] ) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Colegio</th>
                                <th>Camada</th>
                                <th>Vendedor</th>
                                <th>Estado</th>
                                <th>En lista de espera</th>
                                <th>Regulares</th>
                                <th>Registrados</th>
                                <th>Por contrato</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>