<section class="content-header">
    <h1 class="page-header">
        Nuevo Usuario kick
    </h1>
    <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "Personas", "action" => "index"]);?>"> Personas </a>
        </li>
        <li class="active">
            <i class="fa fa-pencil"></i> Nuevo
        </li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($persona) ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                     <div class="form-group">
                                        <?php  echo $this->Form->input('nombre',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                     </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('apellido',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('dni',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="col-md-12" style="padding: 0px">
                                        <div class="col-md-8">
                                             <div class="form-group">
                                                <div><label>Perfil</label></div>
                                                <?php  echo $this->Form->select('perfil',
                                                [
                                                    'MASTER' => 'MASTER',
                                                    'ADMIN' => 'ADMIN',
                                                    'VENTAS' => 'VENTAS',
                                                    'ATENCION' => 'ATENCION'
                                                ],
                                                [
                                                    'required' => true,
                                                    'id' => 'perfil',
                                                    'style' => 'width: 100%',
                                                ] ); ?>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                                            <div class="col-sm-12">

                                <div class="form-group">
                                    <?php  echo $this->Form->input('mail',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <?php  echo $this->Form->input('telefono',  ['required' => false, 'class' => 'form-control' ] ); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                                <div class="form-group">
                                                    <?php  echo $this->Form->input('celular',  ['required' => true, 'class' => 'form-control' ] ); ?>
                                                </div>
                                </div>
                            </div>
                                                                                       <div class="col-sm-12">

                                                           <div class="col-sm-12">
                                                                                                   <?= $this->Form->button(__('Guardar'), ['class'=>'btn btn-success']) ?>
                                                                                                   <?= $this->Html->link(__('Cancelar'), ['action' => 'index'] , array('class'=>'btn btn-primary') ) ?>
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
