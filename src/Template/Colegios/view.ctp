<section class="content-header">
    <h1 class="page-header">
        Colegio
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>"> Colegios </a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i>Colegio
        </li>
    </ol>
</section>
<section class="content">
    <!-- /.row -->
    <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
        <div class="col-sm-12">
            <div class="col-sm-12">
                <div class="form-group">
                   <label>Colegio: </label> <?= h($colegio->nombre)?>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Comentarios: </label> <?= h($colegio->observaciones) ?>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="col-sm-6"  style="padding: 0px">
                    <div class="form-group">
                        <label>Teléfono: </label> <?= h($colegio->telefono) ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Contacto: </label> <?= h($colegio->contacto) ?>
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
                    <label>Calle: </label> <?= h($colegio->direccione->calle) ?>
                 </div>
                  <div class="col-md-12" style="padding: 0px">
                      <div class="col-md-3" style="padding-left: 0px">
                         <div class="form-group">
                            <label>Número: </label> <?= h($colegio->direccione->numero) ?>
                         </div>
                      </div>
                      <div class="col-md-3">
                         <div class="form-group">
                            <label>Piso: </label> <?= h($colegio->direccione->piso) ?>
                         </div>
                      </div>
                      <div class="col-md-3">
                          <div class="form-group">
                            <label>Departamento: </label> <?= h($colegio->direccione->departamento) ?>
                          </div>
                      </div>
                      <div class="col-md-3" style="padding-right:0px">
                          <div class="form-group">
                            <label>Código postal: </label> <?= h($colegio->direccione->codigo_postal) ?>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-12" style="padding: 0px">
                      <div class="col-md-6" style="padding-left: 0px">
                          <div class="form-group">
                            <label>Ciudad: </label> <?= h($colegio->direccione->ciudad) ?>
                          </div>
                      </div>
                      <div class="col-md-6" style="padding-right: 0px">
                            <div class="form-group">
                            <label>País: </label> <?= h($colegio->direccione->pais) ?>
                            </div>
                      </div>
                  </div>
            </div>
        </div>
        </div></div></div>
    </div>
</section>
