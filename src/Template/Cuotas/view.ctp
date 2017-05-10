<section class="content-header">
	<h1 class="page-header">
	    Cuotas
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">Cuotas</li>
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
                                    <h3 class="widget-user-username" id="nombre-grupo"><?= h($tarifa->descripcion)?></h3>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa->fin_pago)?></h5>
                                            <span class="description-text">Fin de pagos</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa->monto_pesos)?></h5>
                                            <span class="description-text">Monto en pesos</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa->monto_dolares)?></h5>
                                            <span class="description-text">Monto en dólares</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-maroon-active" style="height: 30px;padding-top: 5px;padding-bottom: 5px;">
                                    <h5 style='font-size:20px' class="widget-user-username" id="nombre-grupo">Plan de pagos</h5>
                                </div>
                            </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>Vencimiento</td>
                                <td>Monto en pesos</td>
                                <td>Monto en dolares</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cuotas as $cuota): ?>
                            <tr>
                                <td><?= h($cuota->vencimiento)?></td>
                                <td><?= h($cuota->monto_pesos)?></td>
                                <td><?= h($cuota->monto_dolares)?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Vencimiento</td>
                                <td>Monto en pesos</td>
                                <td>Monto en dolares</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $tarifa_aplicada_id] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
