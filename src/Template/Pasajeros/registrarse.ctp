<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                          <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Datos del pasajero</h3>
                            </div>
                                <?= $this->Form->create([$pasajero, $codigoGrupo]) ?>
                            <div class="box-body">
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('codigoGrupo',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.apellido',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.dni',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                               <div class="form-group">
                                  <?php  echo $this->Form->input('persona.fecha_nacimiento',  ['required' => true, 'class' => 'form-control' ] ); ?>
                               </div>
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('persona.nacionalidad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('persona.email',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                    <div class="form-group">
                                       <?php  echo $this->Form->input('persona.telefono',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                    </div>
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('persona.celular',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                            </div>
                            <div class="box-header with-border">
                              <h3 class="box-title">Dirección</h3>
                            </div>
                            <div class="box-body">
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.direccion.calle',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.direccion.numero',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.direccion.piso',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('persona.direccion.departamento',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                  <div class="form-group">
                                   <?php  echo $this->Form->input('persona.direccion.codigo_postal',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                  <div class="form-group">
                                   <?php  echo $this->Form->input('persona.direccion.ciudad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                                <div class="form-group">
                                 <?php  echo $this->Form->input('persona.direccion.pais',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
		                        <?= $this->Form->button(__('Guardar y continuar'), ['class'=>'btn btn-success']) ?>
                                <?= $this->Html->link(__('Cancelar'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                                <?= $this->Form->end() ?>
                            </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </section>
    </div>
</div>