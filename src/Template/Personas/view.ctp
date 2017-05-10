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
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Nombre: </label> <?= h($persona->nombre)?>
                                </div>
                            </div>
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Apellido: </label> <?= h($persona->apellido)?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>DNI: </label> <?= h($persona->dni)?>
                                </div>
                            </div>
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Perfil: </label> <?= h($persona->perfil)?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Email: </label> <?= h($persona->mail)?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Teléfono: </label> <?= h($persona->telefono)?>
                                </div>
                            </div>
                            <div class="col-sm-6"  style="padding: 0px">
                                <div class="form-group">
                                   <label>Celular: </label> <?= h($persona->celular)?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-12"  style="padding: 0px">
                               <?= $this->Html->link(__('Volver'), ['action' => 'index'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                            </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
