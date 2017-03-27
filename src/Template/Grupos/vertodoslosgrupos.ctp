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
                                <th>Estado</th>
                                <th>Precio actual ARS</th>
                                <th>Precio actual USD</th>
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
                                <td>Sebastian Velarde</td>
                                <td><span class="label label-success"><?= h($camada->diccionario->value)?></span></td>
                                <td>0</td>
                                <td>2600</td>
                                <td>No</td>
                                <td>18</td>
                                <td>18</td>
                                <td>20</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-align-center"></i></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><?= $this->Form->postLink('Ver camadas', ['action' => 'view', $camada->id]) ?></li>
                                            <li><?= $this->Html->link('Cambiar status', ['action' => 'edit', $camada->id] ) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Camada</th>
                                <th>Vendedor</th>
                                <th>Estado</th>
                                <th>Precio actual ARS</th>
                                <th>Precio actual USD</th>
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