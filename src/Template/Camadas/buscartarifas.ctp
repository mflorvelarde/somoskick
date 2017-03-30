<section class="content-header">
	<h1 class="page-header">
	    Tarifas
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">Tarifas</li>
	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                    <h3 class="widget-user-username" id="nombre-grupo"><?= h($camada->grupo->nombre)?></h3>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($camada->grupo->codigo_grupo)?></h5>
                                            <span class="description-text">Código de grupo</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($camada->colegio->nombre)?></h5>
                                            <span class="description-text">Colegio</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($camada->año)?></h5>
                                            <span class="description-text">Año</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Tarifa</th>
                                <th>Monto en pesos</th>
                                <th>Monto en dolares</th>
                                <th>Fecha de finalización</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($tarifas as $tarifa): ?>
                            <tr>
                                <td><?= h($tarifa->descripcion)?></td>
                                <td><?= h($tarifa->monto_pesos)?></td>
                                <td><?= h($tarifa->monto_dolares)?></td>
                                <td><?= h($tarifa->fin_pago)?></td>
                                <td><?
                                    echo $this->Html->link(
                                        'Aplicar tarifa',
                                        ['controller' => 'Camadas', 'action' => 'aplicartarifa' . '/' .  $tarifa->id . '/' . $camada->id],
                                        ['class' => 'button btn btn-default']
                                    );
                                 ?>

                                                                <?php
                                                                                 echo $this->Html->link(
                                                                                     $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')),
                                                                                     '#',
                                   array(
                                                       'class'=>'btn btn-danger seleccionar-tarifa',
                                                       'data-toggle'=> 'modal',
                                                       'data-target' => '#ConfirmDelete',
                                                       'escape' => false),
                                                false);
                                                                                 ?>

                                 <a  class="btn btn-danger danger" onclick="seleccionarFecha('<?php echo $tarifa->id?>','<?php echo $camada->id ?>')">Confirm</a>

                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Tarifa</th>
                                <th>Monto en pesos</th>
                                <th>Monto en dolares</th>
                                <th>Fecha de finalización</th>
                                <th> </th>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



 <!-- Modal -->
    <div class="modal fade" id="ConfirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div id="seleccionar-fecha" class="modal-content">

            </div>
        </div>
    </div>



    <script>
      function seleccionarFecha(tarifa_id, camada_id) {
            alert("metodo");
          $.ajax({
            url: '../../camadas/seleccionarfecha/' + tarifa_id + '/' + camada_id,
            success: function(data) {
              $("#seleccionar-fecha").html(data);
            }
          });
        }
    </script>