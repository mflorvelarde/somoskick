
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
            <?= $this->Form->create() ?>
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
                        </tr>
                        <?php foreach ($cuotas as $cuotaAplicada): ?>
                        <tr>
                            <td><?= h($cuotaAplicada->cuota->monto_pesos)?></td>
                            <td><?= h($cuotaAplicada->cuota->monto_colares)?></td>
                            <td><?= h($cuotaAplicada->cuota->vencimiento)?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-xs-12" style="margin-top:25px">
            <?= $this->Form->button('Aceptar plan de cuotas', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>
        </div>
        </form>
    </div>
</section>
