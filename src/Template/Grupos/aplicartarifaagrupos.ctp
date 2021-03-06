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
                        </div>
                        <div class="col-xs-12">
                        <?= $this->Form->create($grupo) ?>
                <!--            <?php foreach ($grupos as $grupo): ?>
                                 <?   echo $this->Form->input(h($grupo->nombre), array('type' => 'checkbox')); ?>
                            <?php endforeach; ?> -->

                            <div class="form-group">
                                <?php echo $this->Form->input('Grupos', array(
                                    'options' => $grupos_options,
                                    'multiple' => 'checkbox'
                                    )); ?>
                            </div>
                            <div class="form-group">
                                <label>Fecha de vencimiento de primera cuota</label>
                               <?php  echo $this->Form->date('primeracuota',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger', 'style' => 'margin-top:1em') ) ?>
                            <?= $this->Form->button(__('Aplicar'), ['class'=>'btn btn-success', 'style' => 'margin-top:1em']) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
