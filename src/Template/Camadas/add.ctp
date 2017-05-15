<section class="content-header">
    <h1 class="page-header">Nueva camada</h1>
     <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "Camadas", "action" => "index"]);?>"> Camadas </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Nueva camada
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($camada, ['enctype' => 'multipart/form-data']) ?>
                    <div class="row">
                        <div class="col-sm-12">
                              <div class="col-sm-12" style="padding: 0px">
                                  <div class="col-sm-6" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('grupo.nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-sm-2">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('año',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-sm-2" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('grupo.pasajeros_estimados',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-sm-2">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('grupo.liberados',  ['required' => false, 'type' => 'number', 'class' => 'form-control' ] ); ?>
                                        </div>
                                  </div>
                              </div>
                            <div class="form-group">
                                <?php  echo $this->Form->input('descripcion',  ['required' => false, 'class' => 'form-control' ] ); ?>
                            </div>
                              <div class="col-sm-12" style="padding: 0px">
                                  <div class="col-sm-4" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php echo $this->Form->input('colegio_id', ['options' => $colegios_options]); ?>
                                        </div>
                                  </div>
                                  <div class="col-sm-4">
                                        <div class="form-group">
                                            <?php echo $this->Form->input('vendedor_id', ['options' => $vendedores]); ?>
                                        </div>
                                  </div>
                                  <div class="col-sm-4" style="padding-right: 0px">
                                        <div class="form-group">
                                            <?php echo $this->Form->input('diccionario_id', ['options' => $estados, 'label' => 'Estado']); ?>
                                        </div>
                                  </div>
                              </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-6" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('contacto1',  ['required' => false, 'class' => 'form-control', 'label' => 'Contacto'] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('contacto2',  ['required' => false,
                                            'class' => 'form-control', 'label' => 'Contacto' ] ); ?>
                                        </div>

                                  </div>
                              </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-6" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('firmante1',  ['required' => false, 'class' => 'form-control', 'label' => 'Firmante'] ); ?>
                                        </div>
                                  </div>
                                  <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('firmante2',  ['required' => false,
                                            'class' => 'form-control', 'label' => 'Firmante' ] ); ?>
                                        </div>

                                  </div>
                              </div>
                              <div class="col-md-12" style="padding: 0px">
                                  <div class="col-md-12" style="padding-left: 0px">
                                        <div class="form-group">
                                            <?php  echo $this->Form->file('file'); ?>
                                        </div>
                                  </div>
                              </div>

                            <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success']) ?>
                            <?= $this->Html->link(__('Cancelar'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
