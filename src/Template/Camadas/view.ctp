
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Camadas<small><?= h($camada->grupo->nombre)?></small></h1>
            <ol class="breadcrumb">
                <li><a href="../admin/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="../../camadas/index"><i class="fa fa-dashboard"></i> Camadas</a></li>
                <li class="active"><?= h($camada->grupo->nombre)?></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom" id="navbar">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-informacion" data-toggle="tab">Información</a></li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown">
                                            Pasajeros<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" href="#tab-pasajeros" onclick="getPasajeros('<?php echo $camada->grupo->id ?>','<?php echo $camada->grupo->nombre ?>', '<?php echo $camada->grupo->pasajeros_estimados ?>')">Lista de pasajeros</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" onclick="show()">Lista de espera</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" href="#">Opcionales</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" href="#tab-acompanantes">Acompañantes</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" href="#">Fichas Médicas</a></li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Kick<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li role="presentation"><a role="menuitem" data-toggle="tab"  tabindex="-1" href="#">Vendedores</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab"  tabindex="-1" href="#">Coordinadores</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab"  tabindex="-1" href="#">Ejecutivo de cuentas</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-widget widget-user">
                                                    <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                                        <h3 class="widget-user-username"><?= h($camada->grupo->nombre)?></h3>
                                                    </div>
                                                </div>
                                                <div class="box box-widget widget-user-2">
                                                    <div class="box-footer no-padding">
                                                            <ul class="nav nav-stacked" id="camada-info">
                                                                <li><a>Colegio <span class="pull-right badge bg-blue"><?= h($camada->colegio->nombre)?></span></a></li>
                                                                <li><a>Año de la camada <span class="pull-right badge bg-red"><?= h($camada->año)?></span></a></li>
                                                                <li><a>Estado <span class="pull-right badge bg-green"><?= h($camada->diccionario->value)?></span></a></li>
                                                                <li><a>Código de grupo <span class="pull-right badge bg-blue"><?= h($camada->grupo->codigo_grupo)?></span></a></li>
                                                                <li><a>Tarifa <span class="pull-right badge bg-green"><?= h($camada->grupo->tarifas__aplicada->tarifa->descripcion)?></span></a></li>
                                                                <li><a>Fecha firma <span class="pull-right badge bg-aqua"><?= h($camada->fecha_firma)?></span></a></li>
                                                                <li><a>Contrato <span class="pull-right badge bg-red">link</span></a></li>
                                                                <li><a>Contacto <span class="pull-right badge bg-green"><?= h($camada->contacto1)?></span></a></li>
                                                                <li><a>Contacto <span class="pull-right badge bg-blue"><?= h($camada->contacto2)?></span></a></li>
                                                            </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <?= $this->Html->link(__('Editar camada'), ['action' => 'edit'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab-pasajeros"></div>
                                    <div class="tab-pane" id="tab-acompanantes">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-widget widget-user">
                                                    <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                                        <h3 class="widget-user-username">Nombre de la camada</h3>
                                                    </div>
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
                                                                <th>Situación</th>
                                                                <th>Cuenta</th>
                                                            </tr>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Florencia Velarde</td>
                                                                <td>1000</td>
                                                                <td>500</td>
                                                                <td>1200</td>
                                                                <td>200</td>
                                                                <td>Deudor</td>
                                                                <td><span class="label label-success">Regular</span></td>
                                                                <td><span class="label label-success">Activo</span></td>

                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Florencia Velarde</td>
                                                                <td>1000</td>
                                                                <td>500</td>
                                                                <td>1200</td>
                                                                <td>200</td>
                                                                <td>Deudor</td>
                                                                <td><span class="label label-danger">Irregular</span></td>
                                                                <td><span class="label label-danger">Inactivo</span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab-espera">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-widget widget-user">
                                                    <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                                        <h3 class="widget-user-username">Nombre de la camada</h3>
                                                    </div>
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
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Florencia Velarde</td>
                                                                <td>1000</td>
                                                                <td>500</td>
                                                                <td>1200</td>
                                                                <td>200</td>
                                                                <td>Deudor</td>
                                                                <td><span class="label label-success">Regular</span></td>
                                                                <td><span class="label label-success">Activo</span></td>

                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Florencia Velarde</td>
                                                                <td>1000</td>
                                                                <td>500</td>
                                                                <td>1200</td>
                                                                <td>200</td>
                                                                <td>Deudor</td>
                                                                <td><span class="label label-danger">Irregular</span></td>
                                                                <td><span class="label label-danger">Inactivo</span></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div>
                            <!-- nav-tabs-custom -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- page script -->
<script>
    function getPasajeros(grupo_id, nombre, estimados){
        $.ajax({
          url: '../../pasajerosdegrupos/pasajerosDeGrupo/' + grupo_id,
          success: function(data) {
            $("#tab-pasajeros").html(data);
            $("#nombre-grupo").html(nombre);
            $("#pasajeros-estimados").html(estimados);

          }
        });
    }
</script>
