<section class="content-header">
    <h1>Mi perfil</h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="#">Mi perfil</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $persona->nombre?>  <?=$persona->apellido?></h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-at margin-r-5"></i> Correo Electrónico</strong>
                    <p class="text-muted"><?=$persona->mail?></p>
                    <hr>
                    <strong><i class="fa fa-calendar margin-r-5"></i> Fecha de nacimiento</strong>
                    <p class="text-muted"><?=$persona->fecha_nacimiento?></p>
                    <hr>
                    <strong><i class="fa fa-id-card-o margin-r-5"></i> DNI</strong>
                    <p class="text-muted"><?=$persona->dni?></p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> Teléfono</strong>
                    <p class="text-muted"><?=$persona->telefono?></p>
                    <hr>
                    <strong><i class="fa fa-mobile margin-r-5"></i> Celular</strong>
                    <p class="text-muted"><?=$persona->celular?></p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
                    <p class="text-muted"><?=$persona->direccione->calle?> <?=$persona->direccione->numero?>
                     <?=$persona->direccione->piso?><?=$persona->direccione->departamento?></p>
                    <p class="text-muted">CP <?=$persona->direccione->codigo_postal?> - <?=$persona->direccione->ciudad?> - <?=$persona->direccione->pais?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <?= $this->Html->link(__('Cambiar contraseña'), ['action' => 'cambiarmicontrasena'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
        </div>
    </div>
</section>

