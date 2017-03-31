<section class="content-header">
    <h1 class="page-header">
        Editar colegio
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <i class="fa fa-user"> </i> <a href="<?php echo $this->Url->build(["controller" => "Colegios", "action" => "index"]);?>"> Colegios </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Editar Colegio
        </li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($colegio) ?>
<div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input text required">
                                    <?php  echo $this->Form->input('nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php  echo $this->Form->input('comentarios',  ['required' => false, 'class' => 'form-control' ] ); ?>
                            </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-6" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('telefono',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('contacto',  ['required' => false, 'class' => 'form-control' ] ); ?>
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
                                    <?php  echo $this->Form->input('direccione.calle',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                 </div>
                                  <div class="col-md-12" style="padding: 0px">
                                      <div class="col-md-3" style="padding-left: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('direccione.numero',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                         </div>
                                      </div>
                                      <div class="col-md-3">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('direccione.piso',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                         </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-group">
                                             <?php  echo $this->Form->input('direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                          </div>
                                      </div>
                                      <div class="col-md-3" style="padding-right:0px">
                                          <div class="form-group">
                                           <?php  echo $this->Form->input('direccione.codigo_postal',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12" style="padding: 0px">
                                      <div class="col-md-6" style="padding-left: 0px">
                                          <div class="form-group">
                                           <?php  echo $this->Form->input('direccione.ciudad',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                          </div>
                                      </div>
                                      <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                             <?php  echo $this->Form->input('direccione.pais',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                            </div>
                                      </div>
                                  </div>
                                  <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success']) ?>
                                  <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                            </div>
                        </div>
                    </div>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</section>