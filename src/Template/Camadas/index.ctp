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
                                <td><?= h($camada->colegio->nombre)?></td>
                                <td><?= h($camada->año)?></td>
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
                                            <li><?php
                                                echo $this->Html->link(
                                                    $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')),
                                                    '#',
                                                    array(
                                                       'class'=>'btn btn-danger btn-confirm',
                                                       'data-toggle'=> 'modal',
                                                       'data-target' => '#ConfirmDelete',
                                                       'action' =>'buscartarifas', $camada->id,
                                                       'escape' => false),
                                                    false);
                                                ?></li>
                                            <li><?= $this->Html->link('Cambiar status', ['action' => 'edit', $camada->id] ) ?></li>
                                            <li><?= $this->Html->link('Cambiar status', ['action' => 'buscartarifas', $camada->id] ) ?></li>
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
</section>


 <!-- Modal -->
    <div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Seleccionar tarifa</h4>
                </div>
                <div class="modal-body">
                            <? echo $this->Form->input(
                                   'tarifa',
                                   [
                                       'type' => 'select',
                                       'multiple' => false,
                                       'options' => $tarifas,
                                       'empty' => true
                                   ]
                               ); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a  class="btn btn-danger danger">Confirm</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
      $(".btn-confirm").on("click", function () {
         var action = $(this).attr('data-action');
         $("form").attr('action',action);
    });
    });
    </script>