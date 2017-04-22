
<section class="content-header">
    <h1>
        Plan de pagos
        <small>Status</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo $this->Url->build(["controller" => "Home", "action" => "clientes"]);?>">Home</a></li>
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
                            <th>Monto pesos</th>
                            <th>Monto dólares</th>
                            <th>Vencimiento</th>
                            <th>Status de pago</th>
                            <th>Status notificación</th>
                            <th>Acciones</th>
                        </tr>
                        <?php foreach ($cuotas as $cuotaAplicada): ?>
                        <tr>
                            <td><?= h($cuotaAplicada->cuota->monto_pesos)?></td>
                            <td><?= h($cuotaAplicada->cuota->monto_colares)?></td>
                            <td><?= h($cuotaAplicada->cuota->vencimiento)?></td>
                            <td><?= $cuotaAplicada->status?></td>
                            <td><?= $cuotaAplicada->statusNotif?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Acciones</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><?= $this->Form->postLink('Cargar notificación', ['action' => 'cargarNotificaciones', $cuotaAplicada->id]) ?></li>
                                        <?php if ($cuotaAplicada->tieneNotificaciones) {?>
                                            <li><?= $this->Form->postLink('Ver notificaciones', ['action' => 'viewNotificaciones', $cuotaAplicada->id]) ?></li>
                                        <?php }?>
                                    </ul>
                                </div>

                            </td>
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

	function showNotif(cuotaID) {
		closeNotifForm(); //Si está el form abierto de carga de notificaciones, lo cierro

        $.ajax({
          url: '../notificacionesPagos/viewnotifications/' + cuotaID,
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