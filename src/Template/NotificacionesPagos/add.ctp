<div class="box-header with-border">
    <h3 class="box-title">Cargar notificación</h3>
</div>
<!-- /.box-header -->
<!-- form start -->
<?= $this->Form->create($notificacion, ['class' => 'form-horizontal']) ?>

<!-- <form class="form-horizontal"> -->
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
