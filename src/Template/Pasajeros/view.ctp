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
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Widget: user widget style 1 -->
                            <div class="box box-widget widget-user">
                                <div class="widget-user-header bg-maroon-active" style="height: 55px">
                                    <h3 class="widget-user-username" id="nombre-grupo"><?= h($pasajero->persona->nombre)?> <?= h($pasajero->persona->apellido)?></h3>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <!-- /.col -->
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->persona->dni)?></h5>
                                                <span class="description-text">DNI</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->pasaporte)?></h5>
                                                <span class="description-text">Pasaporte</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->persona->fecha_nacimiento)?></h5>
                                                <span class="description-text">Fecha de nacimiento</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->persona->telefono)?></h5>
                                                <span class="description-text">Telefono</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->persona->celular)?></h5>
                                                <span class="description-text">Celular</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?= h($pasajero->persona->mail)?></h5>
                                                <span class="description-text">Email</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-12">
                        <div class="box-header with-border">
                          <h3 class="box-title">Dirección</h3>
                        </div>
                        <div class="box-body">
                             <div class="form-group">
                                <label>Calle: </label> <?= h($pasajero->persona->direccione->calle) ?>
                             </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-3" style="padding-left: 0px">
                                     <div class="form-group">
                                        <label>Número: </label> <?= h($pasajero->persona->direccione->numero) ?>
                                     </div>
                                  </div>
                                  <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Piso: </label> <?= h($pasajero->persona->direccione->piso) ?>
                                     </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Departamento: </label> <?= h($pasajero->persona->direccione->departamento) ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3" style="padding-right:0px">
                                      <div class="form-group">
                                        <label>Código postal: </label> <?= h($pasajero->persona->direccione->codigo_postal) ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-6" style="padding-left: 0px">
                                      <div class="form-group">
                                        <label>Ciudad: </label> <?= h($pasajero->persona->direccione->ciudad) ?>
                                      </div>
                                  </div>
                                  <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                        <label>País: </label> <?= h($pasajero->persona->direccione->pais) ?>
                                        </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="box-header with-border">
                          <h3 class="box-title">Dirección</h3>
                        </div>
                        <div class="box-body">
                             <div class="form-group">
                                <label>Calle: </label> <?= h($pasajero->persona->direccione->calle) ?>
                             </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-3" style="padding-left: 0px">
                                     <div class="form-group">
                                        <label>Número: </label> <?= h($pasajero->persona->direccione->numero) ?>
                                     </div>
                                  </div>
                                  <div class="col-md-3">
                                     <div class="form-group">
                                        <label>Piso: </label> <?= h($pasajero->persona->direccione->piso) ?>
                                     </div>
                                  </div>
                                  <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Departamento: </label> <?= h($pasajero->persona->direccione->departamento) ?>
                                      </div>
                                  </div>
                                  <div class="col-md-3" style="padding-right:0px">
                                      <div class="form-group">
                                        <label>Código postal: </label> <?= h($pasajero->persona->direccione->codigo_postal) ?>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-6" style="padding-left: 0px">
                                      <div class="form-group">
                                        <label>Ciudad: </label> <?= h($pasajero->persona->direccione->ciudad) ?>
                                      </div>
                                  </div>
                                  <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                        <label>País: </label> <?= h($pasajero->persona->direccione->pais) ?>
                                        </div>
                                  </div>
                              </div>
                        </div>
                    </div>
                    <!-- TODO: Cerrar el foreach-->
                </div>
            </div>
        </div>
    </div>
</section>
