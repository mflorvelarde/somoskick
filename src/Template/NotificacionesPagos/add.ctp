<section class="content-header">
    <h1 class="page-header">
        Cargar notificación
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "CuotasAplicadas", "action" => "index"]);?>"> Cuotas </a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Cargar notificación?>
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
<?= $this->Form->create($notificacion, ['class' => 'form-horizontal', 'type' => 'file']) ?>

<!-- <form class="form-horizontal"> -->
    <div class="box-body">
        <div class="form-group col-xs-12" style="padding: 0px">
            <div class="col-xs-2" style="text-align:right">
                <label>Medio de pago</label>
            </div>
            <div class="col-xs-10">
                <?php  echo $this->Form->select('paymentType',
                [
                    'trasnferencia' => 'Transferencia bancaria',
                    'deposito' => 'Depósito',
                    'oficina' => 'Oficina'

                ],
                [
                    'required' => true,
                    'id' => 'paymentType',
                    'onchange' => 'setForm()',
                    'class' => 'form-control col-xs-6',
                    'style' => 'width: 100%',
                ] ); ?>
            </div>
        </div>


<!--         <div class="col-md-12" style="padding: 0px">
             <div class="col-md-6" style="padding-left: 0px">
                   <div class="form-group">
                      <?php  echo $this->Form->input('persona.fecha_nacimiento',  ['required' => true, 'class' => 'form-control' ] ); ?>
                   </div>
             </div>
             <div class="col-md-6" style="padding-right: 0px">
                 <div class="form-group">
                    <div><label>Sexo</label></div>
                    <?php  echo $this->Form->select('sexo',
                    [
                        'F' => 'F',
                        'M' => 'M'
                    ],
                    [
                        'required' => true,
                        'id' => 'sexo',
                        'style' => 'width: 100%',
                    ] ); ?>
                 </div>
             </div>
         </div> -->
        <div class="form-group">
            <label for="currency" class="col-sm-2 control-label">Monto</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <div class="col-sm-4">
                        <?php  echo $this->Form->select('moneda',
                        [
                            'pesos' => 'ARS',
                            'dolares' => 'US$'
                        ],
                        [
                            'required' => true,
                            'id' => 'moneda',
                            'style' => 'width: 100%',
                            'label' => false,
                            'class' => 'form-control'
                        ] ); ?>
                    </div>
                    <div class="col-sm-8">
                        <?php  echo $this->Form->input('monto_pesos',  [
                            'required' => true,
                            'class' => 'form-control',
                            'label' => false
                        ]); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="datepicker" class="col-sm-2 control-label">Fecha de Pago</label>
            <div class="col-sm-10">
                <div class="input-group date">
                    <?php  echo $this->Form->input('fecha_pago',  [
                        'required' => true,
                        'class' => 'form-control',
                        'label' => false
                        ]); ?>
                </div>
            </div>
        </div>
        <div id="form-deposito" class="hidden-element">
            <div class="form-group">
                <label for="paymentType" class="col-sm-2 control-label">Ha hecho el depósito mediante</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <?php  echo $this->Form->select('tipoDeposito',
                        [
                            'cheque' => 'Cheque',
                            'efectivo' => 'Efectivo'
                        ],
                        [
                            'required' => true,
                            'id' => 'tipoDeposito',
                            'style' => 'width: 100%',
                            'label' => false,
                            'class' => 'form-control'
                        ] ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="bank" class="col-sm-2 control-label">Banco</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <div class="col-sm-12">
                     <!--   <select class="form-control" id="bank">
                            <option>Santander rio</option>
                            <option>Banco Galicia</option>
                            <option>ICBC</option>
                        </select> -->
                        <?php  echo $this->Form->select('banco',
                        [
                            'santander' => 'Santander Rio',
                            'galicia' => 'Banco Galicia',
                            'icbc' => 'ICBC'
                        ],
                        [
                            'required' => true,
                            'id' => 'banco',
                            'style' => 'width: 100%',
                            'label' => false,
                            'class' => 'form-control'
                        ] ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="sucursal" class="col-sm-2 control-label">Sucursal</label>
                <!--Agregar leyenda de que sea exacto lo que dice el ticket-->
                <div class="col-sm-10">
                    <?php  echo $this->Form->input('sucursal',  [
                        'name' => 'sucursal',
                        'required' => false,
                        'class' => 'form-control',
                        'label' => false,
                        'id' => 'sucursal',
                        ]);
                    ?>
                </div>
            </div>
        </div>
        <div id="form-transferencia">
            <div class="form-group">
                <label for="cuit" class="col-sm-2 control-label">CUIT/CUIL</label>
                <div class="col-sm-10">
                    <?php  echo $this->Form->input('cuit',  [
                        'name' => 'cuit',
                        'required' => false,
                        'class' => 'form-control',
                        'label' => false,
                        'id' => 'cuit',
                        ]);
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label for="banco-destino" class="col-sm-2 control-label">Banco de destino</label>
            <div class="col-sm-10">
                    <div class="form-group">
                        <div class="col-sm-12">
                        <?php  echo $this->Form->select('bancoDestino',
                        [
                            'santander' => 'Santander Rio',
                            'galicia' => 'Banco Galicia',
                            'icbc' => 'ICBC'
                        ],
                        [
                            'required' => true,
                            'id' => 'bancoDestino',
                            'style' => 'width: 100%',
                            'label' => false,
                            'class' => 'form-control'
                        ] ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
          <label for="comprobante" class="col-sm-2 control-label">Comprobante de pago</label>
          <div class="col-sm-10">
                  <?php echo $this->Form->file('submittedfile'); ?>
              <p class="help-block">Example block-level help text here.</p>
            </div>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'irCuotas'] , array('class'=>'btn btn-default') ) ?>
        <button type="submit" class="btn btn-info pull-right">Enviar notificación</button>
    </div>
    <!-- /.box-footer -->
</form>

            </div>
        </div>
    </div>
</section>


<script>
    function setForm() {
		var paymentType = $( "#paymentType" ).val();
		if (paymentType === "deposito") {
			$('#form-transferencia').addClass('hidden-element');
			$('#form-deposito').removeClass('hidden-element');
		} else {
			$('#form-transferencia').removeClass('hidden-element');
			$('#form-deposito').addClass('hidden-element');
		}
	}
</script>