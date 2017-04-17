<section class="content-header">
	<h1 class="page-header">Mi viaje
	</h1>
	<ol class="breadcrumb">
	    <li>
        <li><a href="<?php echo $this->Url->build(["controller" => "Home", "action" => "clientes"]);?>">Home</a></li>
	    </li>
	    <li class="active">Viaje</li>
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
                                <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                    <h3 class="widget-user-username" id="nombre-grupo"><?= h($viaje['destino'])?></h3>
                                </div>
                                <div class="box-footer no-padding">
                                    <ul class="nav nav-stacked" id="camada-info">
                                        <li><a>Colegio <span class="pull-right badge bg-blue"><?= h($camada['colegio']['nombre'])?></span></a></li>
                                        <li><a>Camada <span class="pull-right badge bg-blue"><?= h($camada['grupo']['nombre'])?></span></a></li>
                                    </ul>
                                </div>
                            <div class="box-footer">
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa['fin_pago'])?></h5>
                                            <span class="description-text">Fin de pagos</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa['monto_pesos'])?></h5>
                                            <span class="description-text">Monto en pesos</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-4 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header"><?= h($tarifa['monto_dolares'])?></h5>
                                            <span class="description-text">Monto en dólares</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
