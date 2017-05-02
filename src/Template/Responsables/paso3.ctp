<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="disabled">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Pasajero">
                                <span class="round-tab"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Padre / Tutor">
                                <span class="round-tab"><i class="fa fa-male" aria-hidden="true"></i></span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Madre / Tutora">
                                <span class="round-tab"><i class="fa fa-female" aria-hidden="true"></i></span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Medio de pago">
                                <span class="round-tab"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="tab-content">
                    <div class="tab-pane " role="tabpanel" id="step2">
                    </div>
                    <div class="tab-pane active" role="tabpanel" id="step3">
                   <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Datos de la madre / Tutora</h3>
                            </div>
                            <h4 style="color: orangered; margin-left:10px"> <?= h($mensaje)?></h4>
                            <?= $this->Form->create([$familiar1, $cuitcuil1]) ?>
                            <div class="col-md-12">
                                <?= $this->Html->link(__('No vive'), ['action' => 'saltearesponsable3', $pasajero_id] , array('class'=>'btn bg-maroon margin-bottom', 'style' => 'margin-top:20px') ) ?>
                            </div>
                            <div class="box-body">
                                 <div class="col-md-12" style="padding: 0px">
                                    <div class="col-md-6" style="padding-left: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('persona.nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                         </div>
                                    </div>
                                    <div class="col-md-6" style="padding-right: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('persona.apellido',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                         </div>
                                    </div>
                                 </div>
                                 <div class="col-md-12" style="padding: 0px">
                                    <div class="col-md-6" style="padding-left: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('persona.dni',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                         <div class="form-group">
                                            <div><label>Número de CUIT/CUIL</label></div>
                                            <?php  echo $this->Form->select('cuitcuil1',
                                            [
                                                'Cuit' => 'Cuit',
                                                'Cuil' => 'Cuil'
                                            ],
                                            [
                                                'required' => true,
                                                'id' => 'cuitcuil1',
                                                'style' => 'width: 80%',
                                            ] ); ?>
                                         </div>
                                    </div>
                                    <div class="col-md-4" style="padding: 0px">
                                         <div class="form-group" style="padding-right: 0px">
                                            <?php  echo $this->Form->input('cuit',  ['required' => true, 'class' => 'form-control',
                                                'label' => '' ] ); ?>
                                         </div>
                                     </div>
                                 </div>
                                                                   <div class="col-md-12" style="padding: 0px">
                                                                       <div class="col-md-12" style="padding-left: 0px">
                                                                             <div class="form-group">
                                                                                <?php  echo $this->Form->input('persona.fecha_nacimiento',  ['required' => true, 'class' => 'form-control','minYear' => 1900,'maxYear' => 2010 ] ); ?>
                                                                             </div>
                                                                       </div>
                                                                   </div>
                              <div class="form-group">
                                 <?php  echo $this->Form->input('persona.nacionalidad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                              </div>
                              <div class="form-group">
                                 <?php  echo $this->Form->input('persona.mail',  ['required' => true, 'class' => 'form-control' ] ); ?>
                              </div>
                             <div class="col-md-12" style="padding: 0px">
                              <div class="col-md-6" style="padding-left: 0px">
                                <div class="form-group">
                                   <?php  echo $this->Form->input('persona.telefono',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
                              </div>
                              <div class="col-md-6" style="padding-right: 0px">
                                  <div class="form-group">
                                     <?php  echo $this->Form->input('persona.celular',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                  </div>
                              </div>
                             </div>
                             <a onclick="showAddressPanel();return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Cargar nueva dirección</a>
                            </div>
                        </div>
                        <div class="box box-warning hidden-element" id="madre-adress-panel">
                            <div class="box-header with-border">
                              <h3 class="box-title">Dirección</h3>
                            </div>
                            <div class="col-md-12">
                                <a onclick="hideAddressPanel();return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Misma dirección que el pasajero</a>
                            </div>
                            <div class="box-body">
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('persona.direccione.calle',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-calle' ] ); ?>
                                 </div>
                                 <div class="col-md-12" style="padding: 0px">
                                     <div class="col-md-3" style="padding-left: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('persona.direccione.numero',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-numero' ] ); ?>
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('persona.direccione.piso',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                         </div>
                                     </div>
                                     <div class="col-md-3">
                                          <div class="form-group">
                                             <?php  echo $this->Form->input('persona.direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                          </div>
                                     </div>
                                     <div class="col-md-3" style="padding-right:0px">
                                          <div class="form-group">
                                           <?php  echo $this->Form->input('persona.direccione.codigo_postal',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-codigo-postal' ] ); ?>
                                          </div>
                                     </div>
                                 </div>
                                  <div class="col-md-12" style="padding: 0px">
                                   <div class="col-md-6" style="padding-left: 0px">
                                      <div class="form-group">
                                       <?php  echo $this->Form->input('persona.direccione.ciudad',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-ciudad' ] ); ?>
                                      </div>
                                   </div>
                                   <div class="col-md-6" style="padding-right: 0px">
                                        <div class="form-group">
                                         <?php  echo $this->Form->input('persona.direccione.pais',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-pais' ] ); ?>
                                        </div>
                                   </div>
                                  </div>
                            </div>
                        </div>
                        <?= $this->Form->button(__('Guardar y continuar'), ['class'=>'btn btn-success  btn-info-full']) ?>

                        <div class="clearfix"></div>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step4">

                    </div>
                </div>
        </section>
    </div>
</div>

<script>
    function hideAddressPanel() {
        if ($('#madre-adress-panel').hasClass('hidden-element')) {
        } else {
            $('#madre-calle').removeAttr( "required" );
            $('#madre-numero').removeAttr( "required" );
            $('#madre-codigo-postal').removeAttr( "required" );
            $('#madre-ciudad').removeAttr( "required" );
            $('#madre-pais').removeAttr( "required" );
            $('#madre-calle').val('');
            $('#madre-numero').val('');
            $('#madre-codigo-postal').val('');
            $('#madre-ciudad').val('');
            $('#madre-pais').val('');
            $('#madre-adress-panel').addClass('hidden-element');
        }
    }

    function showAddressPanel() {
        if ($('#madre-adress-panel').hasClass('hidden-element')) {
            $('#madre-calle').attr("required", "true" );
            $('#madre-numero').attr("required", "true" );
            $('#madre-codigo-postal').attr("required", "true" );
            $('#madre-ciudad').attr("required", "true" );
            $('#madre-pais').attr("required", "true" );
            $('#madre-adress-panel').removeClass('hidden-element');

        }
    }
</script>
