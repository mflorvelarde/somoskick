<script type="text/javascript">
    $( document ).ready(function(){
       $('#colegios-table').dynatable();
    });
</script>

<section class="content-header">
	<h1 class="page-header">
	    Colegios
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">Colegios</li>
	</ol>
</section>


<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Nuevo colegio'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="colegios-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Contacto</th>
                                <th>Observaciones</th>
                                <th></th>
                            </tr>
                        </thead>
                        <?php foreach ($colegios as $colegio): ?>
                        <tbody>
                        <tr>
                            <td><?= h($colegio->nombre) ?></td>
                            <td>C.A.B.A.</td>
                            <td><?= $this->Number->format($colegio->direccion_id) ?></td>
                            <td><?= $this->Number->format($colegio->telefono) ?></td>
                            <td><?= h($colegio->contacto) ?></td>
                            <td><?= h($colegio->comentarios) ?></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default">Acciones</button>
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><?= $this->Form->postLink('Ver camadas', ['action' => 'viewCamadas', $colegio->id]) ?></li>
                                        <li><?= $this->Form->postLink('Agregar camadas', ['action' => 'addCamada', $colegio->id]) ?></li>
                                        <li class="divider"></li>
                                        <li><?= $this->Html->link('Ver colegio', ['action' => 'view', $colegio->id] ) ?></li>
                                        <li><?= $this->Html->link('Editar colegio', ['action' => 'edit', $colegio->id] ) ?></li>
                                        <li><?= $this->Form->postLink('Eliminar colegio', ['action' => 'delete', $colegio->id], ['confirm' => __('Confirmar borrado de colegio', $colegio->id)] ) ?></li>

                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Ciudad</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Contacto</th>
                                <th>Observaciones</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
