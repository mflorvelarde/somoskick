<section class="content-header">
	<h1 class="page-header">Pasajeros
	</h1>
	<ol class="breadcrumb">
	    <li>
        <li><a href="<?php echo $this->Url->build(["controller" => "Home", "action" => "admin"]);?>">Home</a></li>
	    </li>
	    <li class="active">Pasajeros</li>
	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="box box-widget widget-user">
                                        <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                            <h3 class="widget-user-username" id="nombre-grupo"><?= h($pasajerodegrupo->pasajero->persona->nombre)?> <?= h($pasajerodegrupo->pasajero->persona->apellido)?></h3>
                                        </div>
                                        <div class="box-footer">
                                            <div class="row">
                                                <div class="col-sm-12 border-right">
                                                    <div class="description-block">
                                                        <h5 class="description-header"><?= h($pasajerodegrupo->grupo->nombre)?></h5>
                                                        <span class="description-text">Camada</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?= $this->Form->create($pasajerodegrupo) ?>
                                        <div class="form-group">
                                            <?php echo $this->Form->input('Tarifas', ['options' => $tarifas_options]); ?>
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
            </div>
        </div>
    </div>
</section>

