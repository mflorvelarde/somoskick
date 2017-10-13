<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
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

                <?= $this->Form->create([$pasajero, $codigoGrupo, $responsable1, $responsable2]) ?>
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                            <div class="step1">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Datos del pasajero</h3>
                                    </div>
                                    <h4 style="color: orangered; margin-left:10px"> <?= h($mensaje)?></h4>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('codigoGrupo',  ['required' => true, 'class' => 'form-control', 'name' => 'codigoGrupo' ] ); ?>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.apellido',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <div><label>DNI</label></div>
                                                    <?php  echo $this->Form->number('pasajero.persona.dni',  ['
                                                        required' => true,
                                                        'min' => '0',
                                                        'class' => 'form-control',
                                                        'label' => 'DNI'
                                                    ]); ?>
                                                    <div><h>Ingresar el número sin puntos</h></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.pasaporte',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <div>
                                                        <label>Fecha de nacimiento</label>
                                                    </div>
                                                    <?php  echo $this->Form->date('pasajero.persona.fecha_nacimiento',  [
                                                        'required' => true,
                                                        'class' => 'form-control',
                                                        'minYear' => 1900,
                                                        'maxYear' => 2010,
                                                        'monthNames' => [
                                                            '',
                                                            'Enero',
                                                            'Febrero',
                                                            'Marzo',
                                                            'Abril',
                                                            'Mayo',
                                                            'Junio',
                                                            'Julio',
                                                            'Agosto',
                                                            'Septiembre',
                                                            'Octubre',
                                                            'Noviembre',
                                                            'Diciembre'
                                                        ]
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px">
                                                <div class="form-group">
                                                    <div><label>Sexo</label></div>
                                                    <?php  echo $this->Form->select('sexo',
                                                    [
                                                    'F' => 'F',
                                                    'M' => 'M'
                                                    ],
                                                    [
                                                    'required' => true,
                                                    'id' => 'pasajero.sexo',
                                                    'style' => 'width: 100%',
                                                    ] ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('pasajero.persona.nacionalidad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                        <div class="form-group">
                                            <div><label>Email</label></div>
                                            <?php  echo $this->Form->email('pasajero.persona.mail',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.telefono', [
                                                        'required' => true,
                                                        'type' => 'number',
                                                        'class' => 'form-control'
                                                    ]); ?>
                                                <div><h>Ingresar el número sin guiones</h></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.celular',  [
                                                        'required' => true,
                                                        'type' => 'number',
                                                        'class' => 'form-control'
                                                    ]); ?>
                                                <div><h>Ingresar el número sin guiones</h></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Dirección</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <?php  echo $this->Form->input('pasajero.persona.direccione.calle',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-3" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.numero',  [
                                                        'required' => true,
                                                        'type' => 'number',
                                                        'class' => 'form-control'
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.piso',  [
                                                        'required' => false,
                                                        'type' => 'number',
                                                        'class' => 'form-control'
                                                    ]); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="padding-right:0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.codigo_postal',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding: 0px">
                                            <div class="col-md-6" style="padding-left: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.ciudad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding-right: 0px">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('pasajero.persona.direccione.pais',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Continuar</button></li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos del padre / Tutor</h3>
                                </div>
                                <h4 style="color: orangered; margin-left:10px"> <?= h($mensaje)?></h4>
                                <div class="col-md-12">
                                    <button type="button" onclick="padreNoVive();return false;"  class="btn btn-default next-step">No vive</button>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.nombre',  [
                                                    'required' => true,
                                                    'class' => 'form-control',
                                                    'id' => 'nombre-padre'
                                                ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.apellido',  [
                                                    'required' => true,
                                                    'class' => 'form-control',
                                                    'id' => 'apellido-padre'
                                                ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.dni',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'id' => 'dni-padre'
                                                ]); ?>
                                            <div><h>Ingresar el número sin puntos</h></div>
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
                                                        'id' => 'responsable1.cuitcuil1',
                                                        'style' => 'width: 80%'
                                                    ]
                                                ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding: 0px">
                                            <div class="form-group" style="padding-right: 0px">
                                                <?php  echo $this->Form->input('responsable1.cuit',  [
                                                    'required' => true,
                                                    'class' => 'form-control',
                                                    'type' => 'number',
                                                    'id' => 'cuit-padre',
                                                    'label' => '' ]
                                                 );?>
                                                <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-12" style="padding-left: 0px">
                                            <div class="form-group">
                                                <div>
                                                    <label>Fecha de nacimiento</label>
                                                </div>
                                                <?php  echo $this->Form->date('responsable1.persona.fecha_nacimiento',  [
                                                    'required' => true,
                                                    'class' => 'form-control',
                                                    'id' => 'nacimiento-padre',
                                                    'minYear' => 1900,
                                                    'maxYear' => 2010,
                                                    'monthNames' => [
                                                        '',
                                                        'Enero',
                                                        'Febrero',
                                                        'Marzo',
                                                        'Abril',
                                                        'Mayo',
                                                        'Junio',
                                                        'Julio',
                                                        'Agosto',
                                                        'Septiembre',
                                                        'Octubre',
                                                        'Noviembre',
                                                        'Diciembre'
                                                    ]
                                                ]
                                                );?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable1.persona.nacionalidad',  [
                                            'required' => true,
                                            'id' => 'nacionalidad-padre',
                                            'class' => 'form-control'
                                        ] ); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable1.persona.mail',  [
                                            'required' => true,
                                            'type' => 'email',
                                            'id' => 'mail-padre',
                                            'class' => 'form-control'
                                        ]); ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.telefono',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'id' => 'telefono-padre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.celular',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'id' => 'celular-padre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a onclick="showAddressPanel1(); return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Cargar nueva dirección</a>
                                </div>
                            </div>
                            <div class="box box-warning hidden-element" id="padre-adress-panel">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Dirección</h3>
                                </div>
                                <div class="col-md-12">
                                    <button onclick="hideAddressPanel1(); return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Misma dirección que el pasajero</button>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable1.persona.direccione.calle',  ['required' => false, 'class' => 'form-control', 'id' => 'padre-calle'] ); ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-3" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.numero',  [
                                                    'required' => false,
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'id' => 'padre-numero'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.piso',  [
                                                    'required' => false,
                                                    'type' => 'number',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-right:0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.codigo_postal',  ['required' => false, 'class' => 'form-control', 'id' => 'padre-codigo-postal' ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.ciudad',  ['required' => false, 'class' => 'form-control', 'id' => 'padre-ciudad' ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable1.persona.direccione.pais',  ['required' => false, 'class' => 'form-control', 'id' => 'padre-pais' ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Paso anterior</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Continuar</button></li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="box box-warning">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Datos de la madre / Tutora</h3>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" onclick="madreNoVive();return false;"  class="btn btn-default next-step">No vive</button>
                                </div>
                                <h4 style="color: orangered; margin-left:10px"> <?= h($mensaje)?></h4>

                                <div class="box-body">
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.nombre',  [
                                                    'required' => true,
                                                    'id' => 'nombre-madre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.apellido',  [
                                                    'required' => true,
                                                    'id' => 'apellido-madre',
                                                    'class' => 'form-control'
                                                ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.dni',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'id' => 'dni-madre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            <div><h>Ingresar el número sin puntos</h></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div><label>Número de CUIT/CUIL</label></div>
                                                <?php  echo $this->Form->select('cuitcuil2',
                                                [
                                                    'Cuit' => 'Cuit',
                                                    'Cuil' => 'Cuil'
                                                ],
                                                [
                                                    'required' => true,
                                                    'id' => 'responsable2.cuitcuil2',
                                                    'style' => 'width: 80%',
                                                ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding: 0px">
                                            <div class="form-group" style="padding-right: 0px">
                                                <?php  echo $this->Form->input('responsable2.cuit',  [
                                                   'required' => true,
                                                    'class' => 'form-control',
                                                    'id' => 'cuit-madre',
                                                    'type' => 'number',
                                                    'label' => ''
                                                ]); ?>
                                            <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-12" style="padding-left: 0px">
                                            <div class="form-group">
                                                <div>
                                                    <label>Fecha de nacimiento</label>
                                                </div>
                                                <?php  echo $this->Form->date('responsable2.persona.fecha_nacimiento',  [
                                                    'required' => true,
                                                    'class' => 'form-control',
                                                    'id' => 'nacimiento-madre',
                                                    'minYear' => 1900,
                                                    'maxYear' => 2010,
                                                    'monthNames' => [
                                                        '',
                                                        'Enero',
                                                        'Febrero',
                                                        'Marzo',
                                                        'Abril',
                                                        'Mayo',
                                                        'Junio',
                                                        'Julio',
                                                        'Agosto',
                                                        'Septiembre',
                                                        'Octubre',
                                                        'Noviembre',
                                                        'Diciembre'
                                                    ]
                                                ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable2.persona.nacionalidad',  [
                                            'required' => true,
                                            'id' => 'nacionalidad-madre',
                                            'class' => 'form-control'
                                        ]); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable2.persona.mail',  [
                                            'required' => true,
                                            'type' => 'email',
                                            'id' => 'mail-madre',
                                            'class' => 'form-control'
                                        ]); ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.telefono',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'id' => 'telefono-madre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.celular',  [
                                                    'required' => true,
                                                    'type' => 'number',
                                                    'id' => 'celular-madre',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            <div><h>Ingresar el número sin guiones</h></div>
                                            </div>
                                        </div>
                                    </div>
                                    <a onclick="showAddressPanel2();return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Cargar nueva dirección</a>
                                </div>
                            </div>
                            <div class="box box-warning hidden-element" id="madre-adress-panel">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Dirección</h3>
                                </div>
                                <div class="col-md-12">
                                    <a onclick="hideAddressPanel2();return false;" class="btn bg-maroon margin-bottom" style="margin-top:20px">Misma dirección que el pasajero</a>
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('responsable2.persona.direccione.calle',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-calle' ] ); ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-3" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.numero',  [
                                                    'required' => false,
                                                    'type' => 'number',
                                                    'class' => 'form-control',
                                                    'id' => 'madre-numero'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.piso',  [
                                                    'required' => false,
                                                    'type' => 'number',
                                                    'class' => 'form-control'
                                                ]); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-right:0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.codigo_postal',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-codigo-postal' ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-6" style="padding-left: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.ciudad',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-ciudad' ] ); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px">
                                            <div class="form-group">
                                                <?php  echo $this->Form->input('responsable2.persona.direccione.pais',  ['required' => false, 'class' => 'form-control', 'id' => 'madre-pais' ] ); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Paso anterior</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Continuar</button></li>
                            </ul>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="complete">
                            <div class="step44">
                                <div class="box box-warning">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Datos de pago</h3>
                                    </div>
                                        <h4 style="color: orangered; margin-left:10px"> <?= h($mensaje)?></h4>
                                        <div class="box-body">
                                            <div class="col-md-12" style="padding: 0px">
                                                <div class="col-md-5" style="padding-left: 0px">
                                                    <div class="form-group">
                                                        <div><label>Tipo de factura</label></div>
                                                        <?php  echo $this->Form->select('medioPago.tipo_factura',
                                                            [
                                                                'A' => 'A',
                                                                'B' => 'B'
                                                            ],
                                                            [
                                                                'required' => true,
                                                                'id' => 'tipo-factura',
                                                                'style' => 'width: 80%',
                                                            ] )
                                                        ; ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <div><label>Número de CUIT/CUIL</label></div>
                                                            <?php  echo $this->Form->select('medioPago.cuitcuil',
                                                                [
                                                                    'Cuit' => 'Cuit',
                                                                    'Cuil' => 'Cuil'
                                                                ],
                                                                [
                                                                    'required' => true,
                                                                    'id' => 'cuitcuil',
                                                                    'style' => 'width: 80%',
                                                                ]
                                                            );?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5" style="padding-right: 0px">
                                                        <div class="form-group" style="padding-right: 0px">
                                                            <?php  echo $this->Form->input('medioPago.cuit',  [
                                                                'required' => true,
                                                                'class' => 'form-control',
                                                                'type' => 'number',
                                                                'label' => ''
                                                            ]);?>
                                                         <div><h>Ingresar el número sin guiones</h></div>
                                                        </div>
                                                   </div>
                                                </div>
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('medioPago.razon_social',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                                <div class="form-group">
                                                    <div><label>Condición ante el IVA</label></div>
                                                        <?php  echo $this->Form->select('medioPago.condicionIVA',
                                                            [
                                                                'C - Consumidor final' => 'C - Consumidor final',
                                                                'E - Exento' => 'E - Exento',
                                                                'M - Resp. Monotributo' => 'M - Resp. Monotributo',
                                                                'I - Responsable inscripto' => 'I - Responsable inscripto'
                                                            ],
                                                            [
                                                                'required' => true,
                                                            ]
                                                        );?>
                                                    </div>
                                                </div>
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">Dirección</h3>
                                                </div>
                                                <div class="box-body">
                                                    <div class="form-group">
                                                        <?php  echo $this->Form->input('medioPago.direccione.calle',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                    </div>
                                                    <div class="col-md-12" style="padding: 0px">
                                                        <div class="col-md-3" style="padding-left: 0px">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.numero',  [
                                                                    'required' => true,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control'
                                                                ]); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.piso',  [
                                                                    'required' => false,
                                                                    'type' => 'number',
                                                                    'class' => 'form-control'
                                                                ]); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.departamento',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3" style="padding-right:0px">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.codigo_postal',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12" style="padding: 0px">
                                                        <div class="col-md-6" style="padding-left: 0px">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.ciudad',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" style="padding-right: 0px">
                                                            <div class="form-group">
                                                                <?php  echo $this->Form->input('medioPago.direccione.pais',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-inline pull-right">
                                                <li><button type="button" class="btn btn-default prev-step">Paso anterior</button></li>
                                                <li><?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success  btn-info-full']) ?></li>
                                            </ul>
                                            <div class="clearfix"></div>
                                            <div class="clearfix"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
<script>
    function hideAddressPanel1() {
        if ($('#padre-adress-panel').hasClass('hidden-element')) {
        } else {
            $('#padre-calle').removeAttr( "required" );
            $('#padre-numero').removeAttr( "required" );
            $('#padre-codigo-postal').removeAttr( "required" );
            $('#padre-ciudad').removeAttr( "required" );
            $('#padre-pais').removeAttr( "required" );
            $('#padre-calle').val('');
            $('#padre-numero').val('');
            $('#padre-codigo-postal').val('');
            $('#padre-ciudad').val('');
            $('#padre-pais').val('');
            $('#padre-adress-panel').addClass('hidden-element');
        }
    }

    function showAddressPanel1() {
        if ($('#padre-adress-panel').hasClass('hidden-element')) {
            $('#padre-calle').attr("required", "true" );
            $('#padre-numero').attr("required", "true" );
            $('#padre-codigo-postal').attr("required", "true" );
            $('#padre-ciudad').attr("required", "true" );
            $('#padre-pais').attr("required", "true" );
            $('#padre-adress-panel').removeClass('hidden-element');
        }
    }

    function hideAddressPanel2() {
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

    function showAddressPanel2() {
        if ($('#madre-adress-panel').hasClass('hidden-element')) {
            $('#madre-calle').attr("required", "true" );
            $('#madre-numero').attr("required", "true" );
            $('#madre-codigo-postal').attr("required", "true" );
            $('#madre-ciudad').attr("required", "true" );
            $('#madre-pais').attr("required", "true" );
            $('#madre-adress-panel').removeClass('hidden-element');

        }
    }

    function padreNoVive() {
        $('#nombre-padre').removeAttr( "required" );
        $('#apellido-padre').removeAttr( "required" );
        $('#dni-padre').removeAttr( "required" );
        $('#telefono-padre').removeAttr( "required" );
        $('#celular-padre').removeAttr( "required" );
        $('#cuit-padre').removeAttr( "required" );
        $('#nacimiento-padre').removeAttr( "required" );
        $('#nacionalidad-padre').removeAttr( "required" );
        $('#mail-padre').removeAttr( "required" );
        $('#mail-padre').val('');
    }


    function madreNoVive() {
        $('#nombre-madre').removeAttr( "required" );
        $('#apellido-madre').removeAttr( "required" );
        $('#dni-madre').removeAttr( "required" );
        $('#telefono-madre').removeAttr( "required" );
        $('#celular-madre').removeAttr( "required" );
        $('#cuit-madre').removeAttr( "required" );
        $('#nacimiento-madre').removeAttr( "required" );
        $('#nacionalidad-madre').removeAttr( "required" );
        $('#mail-madre').removeAttr( "required" );
        $('#mail-madre').val('');
    }
</script>
<script>
    $(document).ready(function () {
        //Initialize tooltips
        $('.nav-tabs > li a[title]').tooltip();

        //Wizard
        $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

            var $target = $(e.target);

            if ($target.parent().hasClass('disabled')) {
                return false;
            }
        });

        $(".next-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);

        });
        $(".prev-step").click(function (e) {

            var $active = $('.wizard .nav-tabs li.active');
            prevTab($active);

        });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }


    //according menu

    $(document).ready(function()
    {
        //Add Inactive Class To All Accordion Headers
        $('.accordion-header').toggleClass('inactive-header');

        //Set The Accordion Content Width
        var contentwidth = $('.accordion-header').width();
        $('.accordion-content').css({});

        //Open The First Accordion Section When Page Loads
        $('.accordion-header').first().toggleClass('active-header').toggleClass('inactive-header');
        $('.accordion-content').first().slideDown().toggleClass('open-content');

        // The Accordion Effect
        $('.accordion-header').click(function () {
            if($(this).is('.inactive-header')) {
                $('.active-header').toggleClass('active-header').toggleClass('inactive-header').next().slideToggle().toggleClass('open-content');
                $(this).toggleClass('active-header').toggleClass('inactive-header');
                $(this).next().slideToggle().toggleClass('open-content');
            }

            else {
                $(this).toggleClass('active-header').toggleClass('inactive-header');
                $(this).next().slideToggle().toggleClass('open-content');
            }
        });

        return false;
    });
</script>

