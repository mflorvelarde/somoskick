
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Camadas<small>Nombre de la camada</small></h1>
            <ol class="breadcrumb">
                <li><a href="../admin/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="../admin/camadas.php"><i class="fa fa-dashboard"></i> Camadas</a></li>
                <li class="active">Nombre Camada</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab-informacion" data-toggle="tab">Información</a></li>
<!--                                    <li><a href="#tab-" data-toggle="tab">Pasajeros</a></li>-->
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            Pasajeros<span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1"  onclick="getPasajeros('<?php echo $camada->id ?>')">Lista de pasajeros</a></li>
                                            <li role="presentation"><a role="menuitem" data-toggle="tab" tabindex="-1" href="#tab-espera">Lista de espera</a></li>
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
                                    <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab-informacion">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-widget widget-user">
                                                    <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                                        <h3 class="widget-user-username">Nombre de la camada</h3>
                                                    </div>
                                                </div>
                                                <div class="box box-widget widget-user-2">
                                                    <div class="box-footer no-padding">
                                                            <ul class="nav nav-stacked">
                                                                <li><a href="#">Colegio <span class="pull-right badge bg-blue">Manuel belgrano</span></a></li>
                                                                <li><a href="#">Código de grupo <span class="pull-right badge bg-blue">SVP23</span></a></li>
                                                                <li><a href="#">Estado <span class="pull-right badge bg-green">Firmada</span></a></li>
                                                                <li><a href="#">Fecha firma <span class="pull-right badge bg-aqua">23/01/2016</span></a></li>
                                                                <li><a href="#">Tarifa <span class="pull-right badge bg-green">Tarifa SP 2017 23</span></a></li>
                                                                <li><a href="#">Año de la camada <span class="pull-right badge bg-red">2017</span></a></li>
                                                                <li><a href="#">Contrato <span class="pull-right badge bg-red">link</span></a></li>
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
                                    <div class="tab-pane" id="tab-pasajeros">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <!-- Widget: user widget style 1 -->
                                                <div class="box box-widget widget-user">
                                                <div class="box box-widget widget-user">
                                                    <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                                        <h3 class="widget-user-username">Nombre de la camada</h3>
                                                    </div>
                                                </div>
                                                    <div class="box-footer">
                                                        <div class="row">
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">36 / 45</h5>
                                                                    <span class="description-text">Usuarios registrados</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">20</h5>
                                                                    <span class="description-text">Hombres</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-2 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">16</h5>
                                                                    <span class="description-text">Mujeres</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-3 border-right">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">0,00 / 0,00</h5>
                                                                    <span class="description-text">Total pagado ARS</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                            <div class="col-sm-3">
                                                                <div class="description-block">
                                                                    <h5 class="description-header">9486,30 / 93600,00</h5>
                                                                    <span class="description-text">Total pagado USD</span>
                                                                </div>
                                                                <!-- /.description-block -->
                                                            </div>
                                                            <!-- /.col -->
                                                        </div>
                                                        <!-- /.row -->
                                                    </div>
                                                </div>
                                                <!-- /.widget-user -->


                                                <div class="box">
                                                    <div class="box-header">
                                                        <h3 class="box-title">Pasajeros Activos</h3>
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
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    function getPasajeros(camada_id)
    {
        $.ajax({
          url: '../pasajeros/list_all/' + camada_id,
          success: function(data)
          {
            alert(data);

          }
        });
    }
</script>
