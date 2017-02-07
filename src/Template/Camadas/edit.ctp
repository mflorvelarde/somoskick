<section class="content-header">
    <h1 class="page-header">Editar camada</h1>
     <ol class="breadcrumb">
        <li>
            <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">
            <a href="<?php echo $this->Url->build(["controller" => "Camadas", "action" => "index"]);?>"> Camadas </a>
        </li>

        <li class="active">
            <i class="fa fa-pencil"></i> Editar camada
        </li>

    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?= $this->Form->create($camada) ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <?php  echo $this->Form->input('descripcion',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>

                            <div class="form-group">
                                <?php  echo $this->Form->input('año',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>

                            <div class="form-group">
                                <?php  echo $this->Form->input('contacto1',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>
                            <div class="form-group">
                                <label for="tarifa" class="control-label">Tarifa</label>
                                    <div class="form-group">
                                        <select class="form-control" id="tarifa">
                                            <option>Tarifa 1</option>
                                            <option>Tarfifa 2</option>
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group">
                                <?php  echo $this->Form->input('contacto2',  ['required' => true, 'class' => 'form-control' ] ); ?>
                            </div>
                            <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-success'] ) ?>
                            <?= $this->Html->link(__('Cancelar'), ['action' => 'index'] , array('class'=>'btn btn-danger') ) ?>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>