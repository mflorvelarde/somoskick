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
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="MAdre / Tutora">
                                <span class="round-tab"><i class="fa fa-female" aria-hidden="true"></i></span>
                            </a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Medio de pago">
                                <span class="round-tab"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step4">
                          <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Datos de pago</h3>
                            </div>
                                <?= $this->Form->create([$medioPago, $cuitcuil]) ?>
                            <div class="box-body">
                                 <div class="col-md-12" style="padding: 0px">
                                    <div class="col-md-5" style="padding-left: 0px">
                                        <div class="form-group">
                                            <div><label>Tipo de factura</label></div>
                                            <?php  echo $this->Form->select('tipo_factura',
                                            [
                                                'A' => 'A',
                                                'B' => 'B'
                                            ],
                                            [
                                                'required' => true,
                                                'id' => 'tipo-factura',
                                                'style' => 'width: 80%',
                                            ] ); ?>
                                         </div>
                                    </div>
                                    <div class="col-md-2">
                                         <div class="form-group">
                                            <div><label>Número de CUIT/CUIL</label></div>
                                            <?php  echo $this->Form->select('cuitcuil',
                                            [
                                                'Cuit' => 'Cuit',
                                                'Cuil' => 'Cuil'
                                            ],
                                            [
                                                'required' => true,
                                                'id' => 'cuitcuil',
                                                'style' => 'width: 80%',
                                            ] ); ?>
                                         </div>
                                    </div>
                                    <div class="col-md-5" style="padding-right: 0px">
                                         <div class="form-group" style="padding-right: 0px">
                                            <?php  echo $this->Form->input('cuit',  ['required' => true, 'class' => 'form-control',
                                                'label' => '' ] ); ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                    <?php  echo $this->Form->input('razon_social',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="form-group">
                                    <div><label>Condición ante el IVA</label></div>
                                    <?php  echo $this->Form->select('condicionIVA',
                                    [
                                        'C - Consumidor final' => 'C - Consumidor final',
                                        'E - Exento' => 'E - Exento',
                                        'M - Resp. Monotributo' => 'M - Resp. Monotributo',
                                        'I - Responsable inscripto' => 'I - Responsable inscripto'
                                    ],
                                    [
                                        'required' => true,
                                    ] ); ?>
                                 </div>
                            </div>
                            <div class="box-header with-border">
                              <h3 class="box-title">Dirección</h3>
                            </div>
                            <div class="box-body">

                                 <div class="form-group">
                                    <?php  echo $this->Form->input('direccione.calle',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                 </div>
                                 <div class="col-md-12" style="padding: 0px">
                                      <div class="col-md-3" style="padding-left: 0px">
                                         <div class="form-group">
                                            <?php  echo $this->Form->input('direccione.numero',  ['required' => true, 'class' => 'form-control' ] ); ?>
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
                                           <?php  echo $this->Form->input('direccione.codigo_postal',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                          </div>
                                       </div>
                                   </div>
                                   <div class="col-md-12" style="padding: 0px">
                                    <div class="col-md-6" style="padding-left: 0px">
                                          <div class="form-group">
                                           <?php  echo $this->Form->input('direccione.ciudad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                          </div>
                                    </div>
                                    <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                             <?php  echo $this->Form->input('direccione.pais',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                            </div>
                                    </div>
                                   </div>
                                <?= $this->Form->button(__('Guardar y continuar'), ['class'=>'btn btn-success  btn-info-full']) ?>
                            </div>
                        </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </section>
    </div>
</div>