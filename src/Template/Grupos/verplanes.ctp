<script type="text/javascript">
    $( document ).ready(function(){
       $('#tarifas-table').dynatable();
    });
</script>
<section class="content-header">
	<h1 class="page-header">
	    Tarifas
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">
		<i class="fa fa-user"></i> Tarifas
	    </li>
	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="tarifas-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Grupo</th>
                                <th>Tarifa</th>
                                <th>Contrato</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grupos as $grupo): ?>
                            <tr>
                                <td><?= h($grupo->nombre) ?></td>
                                <td><?= h($grupo->tarifas_aplicada->tarifa->descripcion) ?></td>
                                <td><?= h($grupo->nombre) ?></td>
                                <td class="actions">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">Acciones</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><?= $this->Html->link('Ver plan', ['controller' => 'Cuotas','action' => 'view', $grupo->tarifas_aplicada->id]) ?></li>
                                            <li><?= $this->Html->link('Editar plan', ['controller' => 'Cuotas', 'action' => 'edit', $grupo->tarifas_aplicada->id]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <th>Grupo</th>
                            <th>Tarifa</th>
                            <th>Contrato</th>
                            <th></th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
