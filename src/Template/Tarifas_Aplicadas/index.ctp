
<section class="content-header">
    <h1>
        Plan de pagos
        <small>Status</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="../clients/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pagos</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cuotas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Cuota</th>
                            <th>Moneda</th>
                            <th>Monto</th>
                            <th>Monto abonado</th>
                            <th>Monto a pagar</th>
                            <th>Vencimiento</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        <tr>
                            <td>183</td>
                            <td>ARS</td>
                            <td>3600</td>
                            <td>3600</td>
                            <td>3600</td>
                            <td>11-7-2014</td>
                            <td><span class="label label-success">Pago acreditado</span></td>
                            <td>
                                <button type="button" class="btn btn-block btn-default btn-xs"
                                        onclick="showNotif(183)" style="width:120px">Ver notificación
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>219</td>
                            <td>ARS</td>
                            <td>3600</td>
                            <td>0</td>
                            <td>3600</td>
                            <td>11-7-2014</td>
                            <td><span class="label label-warning">Pendiente de aprobación</span></td>
                            <td>
                                <button type="button" class="btn btn-block btn-default btn-xs"
                                        onclick="showNotif(219)" style="width:120px">Ver notificación
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>657</td>
                            <td>ARS</td>
                            <td>3600</td>
                            <td>0</td>
                            <td>3600</td>
                            <td>11-7-2014</td>
                            <td><span class="label label-primary">Sin notificación</span></td>
                            <td>
                                <button type="button" class="btn btn-block btn-default btn-xs cargar-notif"
                                        onclick="openNotifForm(657)" style="width:120px">Cargar notificación
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>175</td>
                            <td>ARS</td>
                            <td>3600</td>
                            <td>0</td>
                            <td>3600</td>
                            <td>11-7-2014</td>
                            <td><span class="label label-danger">Vencido</span></td>
                            <td>
                                <button type="button" class="btn btn-block btn-default btn-xs"
                                        onclick="showNotif(175)" style="width:120px">Ver notificación
                                </button>
                                <button type="button" class="btn btn-block btn-default btn-xs cargar-notif"
                                        onclick="openNotifForm(175)" style="width:120px">Cargar notificación
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- Horizontal Form -->
            <div id="form-carga-notificaciones" class="box box-info hidden-element">
                <div class="box-header with-border">
                    <h3 class="box-title">Cargar notificación</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nroCuota" class="col-sm-2 control-label">Cuota</label>
                            <div class="col-sm-10">
                                <input id="cuota-id" type="text" class="form-control" value="#Cuota" disabled="true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paymentType" class="col-sm-2 control-label">Medio de pago</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                    <select class="form-control" id="paymentType"  onchange="setForm()">
                                        <option disabled selected value>   </option>
                                        <option value="transferencia">Transferencia bancaria</option>
                                        <option value="deposito">Depósito</option>
                                        <option value="oficina">Oficina</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="currency" class="col-sm-2 control-label">Monto</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <select class="form-control" id="currency">
                                        <option>ARS</option>
                                        <option>US$</option>
                                    </select></div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="amount">
                                    </div>
                                    Agregar validacion + leyenda
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="datepicker" class="col-sm-2 control-label">Fecha de Pago</label>
                            <div class="col-sm-10">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="datepicker">
                                </div>
                            </div>
                        </div>
                        <div id="form-deposito" class="hidden-element">
                            <div class="form-group">
                                <label for="paymentType" class="col-sm-2 control-label">Ha hecho el depósito mediante</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <select class="form-control" id="paymentType">
                                            <option disabled selected value>   </option>
                                            <option>Cheque</option>
                                            <option>Efectivo</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bank" class="col-sm-2 control-label">Banco</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <select class="form-control" id="bank">
                                            <option>Santander rio</option>
                                            <option>Banco Galicia</option>
                                            <option>ICBC</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sucursal" class="col-sm-2 control-label">Sucursal</label>
                                <!--Agregar leyenda de que sea exacto lo que dice el ticket-->
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="sucursal">
                                </div>
                            </div>
                        </div>
                        <div id="form-transferencia" class="hidden-element">
                            <div class="form-group">
                                <label for="cuit" class="col-sm-2 control-label">CUIT/CUIL</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="cuit">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="banco-destino" class="col-sm-2 control-label">Banco de destino</label>
                            <div class="col-sm-10">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                        <select class="form-control" id="banco-destino">
                                            <option>Santander rio</option>
                                            <option>Banco Galicia</option>
                                            <option>ICBC</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="comprobante" class="col-sm-2 control-label">Comprobante de pago</label>
                          <div class="col-sm-10">
                              <input type="file" id="comprobante">
                              <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-default" onclick="closeNotifForm()">Cancelar</button>
                        <button type="submit" class="btn btn-info pull-right">Enviar notificación</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
                        <div class="row">
        <div id="notif" class="col-xs-12"></div>
    </div>
</section>


<script>
    $(function () {
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true
        });
    });
</script>

<script>
    function setForm() {
		var paymentType = $( "#paymentType" ).val();
		if (paymentType === "deposito") {
			$('#form-transferencia').addClass('hidden-element');
			$('#form-deposito').removeClass('hidden-element');
		} else if (paymentType === "transferencia") {
			$('#form-deposito').addClass('hidden-element');
			$('#form-transferencia').removeClass('hidden-element');
		} else {
			$('#form-transferencia').addClass('hidden-element');
			$('#form-deposito').addClass('hidden-element');
		}
	}

	function openNotifForm(id){
		closeNotifSection();
		$('#cuota-id').val(id);
		$('#form-carga-notificaciones').removeClass('hidden-element');
	}

	function closeNotifForm() {
		$('#form-carga-notificaciones').addClass('hidden-element');
	}

	function showNotif(cuotaID) {
		closeNotifForm(); //Si está el form abierto de carga de notificaciones, lo cierro

		var statusNotif = "Acreditada";
		var medioPago = "Depósito";
		var moneda = "ARS";
		var monto = 15478;
		var fechaPago = "11-7-2016";

		var body = "<div class='box box-solid'>";
		body +=	"<div class='box-header with-border'>";
		body += "<h3 class='box-title'>Notificación de pago<span class='label label-success'>" + statusNotif + "</span></h3>";
		body +=	"</div>"; //Cierro el header
		body += "<div class='box-body'>";
		body += "<dl class='dl-horizontal'>";
		body += "<dt>Cuota</dt>";
		body += "<dd>" + cuotaID + "</dd>";
		body += "<dt>Medio de pago</dt>";
		body += "<dd>" + medioPago + "</dd>";
		body += "<dt>Monto</dt>";
		body += "<dd>" + moneda + "  " + monto +"</dd>";
		body +=	"<dt>Fecha de pago</dt>";
		body += "<dd>" + fechaPago + "</dd>";
		body += "</dl>";
		body += "</div>";
		//Agrego el boton para cerrar
		body += "<div class='box-footer'>";
        body += "<button class='btn btn-default' onclick='closeNotifSection()'>Cerrar</button>";
        body += "</div>";

		body += "</div>";

		$("#notif").html(body);
		$("#notif").removeClass("hidden-element");
	}

	function closeNotifSection() {
		$("#notif").addClass("hidden-element");
	}
</script>