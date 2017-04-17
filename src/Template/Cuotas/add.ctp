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
                    <h3 style="margin-bottom: 20px; color: red; background-color: #FBEFEF;"><?= h($error)?></h3>
                    <table id="example1" class="table table-bordered table-striped">
                        <?php foreach ($cuotas as $cuota): ?>
                        <?php $i = 0?>
                        <?= $this->Form->create($cuota) ?>

                        <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <div class="input text required">
                                            <?php  echo $this->Form->input('vencimiento',  ['required' => true, ['class' => 'form-control'] ] ); ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input text required">
                                            <?php  echo $this->Form->input('monto_pesos',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input text required">
                                            <?php  echo $this->Form->input('monto_dolares',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                                                    <?php $i = $i + 1?>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger', 'style' => 'margin-top:1em') ) ?>
                    <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success', 'style' => 'margin-top:1em']) ?>
                </div>
            </div>
        </div>
    </div>
</section>
