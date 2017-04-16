
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
        <!-- Horizontal Form -->
            <div id="form-carga-notificaciones" class="box box-info hidden-element">
            </div>
            <!-- /.box -->
            <div class="row">
                <div id="notif" class="col-xs-12 hidden-element"></div>
            </div>
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cuotas</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>Cuota</th>
                            <th>Monto pesos</th>
                            <th>Monto dólares</th>
                            <th>Monto abonado en pesos</th>
                            <th>Monto abonado en dolares</th>
                            <th>Vencimiento</th>
                            <th>Estado de cuota</th>
                            <th>Estado de notificación</th>
                            <th>Acciones</th>
                        </tr>
                        <?php foreach ($cuotas as $cuotaAplicada): ?>
                        <tr>
                            <td><?= h($cuotaAplicada->id)?></td>
                            <td><?= h($cuotaAplicada->cuota->monto_pesos)?></td>
                            <td><?= h($cuotaAplicada->cuota->monto_colares)?></td>
                            <td>3400</td>
                            <td>3600</td>
                            <td><?= h($cuotaAplicada->cuota->vencimiento)?></td>
                            <td><span class="label label-success">Pago acreditado</span></td>
                            <td><span class="label label-success">Pago acreditado</span></td>
                            <td><?= $cuotaAplicada->boton?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
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
        $.ajax({
          url: '../../appkick/notificacionesPagos/add/' + id,
          success: function(data) {
            $("#form-carga-notificaciones").html(data);
    		$('#form-carga-notificaciones').removeClass('hidden-element');
          }
        });
	}

	function showNotif(cuotaID) {
		closeNotifForm(); //Si está el form abierto de carga de notificaciones, lo cierro

        $.ajax({
          url: '../../appkick/notificacionesPagos/viewnotifications/' + cuotaID,
          success: function(data) {
            $("#notif").html(data);
            $("#notif").removeClass("hidden-element");
          }
        });
	}

	function closeNotifSection() {
		$("#notif").addClass("hidden-element");
	}


	function closeNotifForm() {
		$("#form-carga-notificaciones").addClass("hidden-element");
	}
</script>