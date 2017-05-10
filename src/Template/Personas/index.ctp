<script type="text/javascript">
    $( document ).ready(function(){
       $('#tarifas-table').dynatable();
    });
</script>
<section class="content-header">
	<h1 class="page-header">
	    Usuarios @ Kick
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">
		<i class="fa fa-user"></i>Ususarios
	    </li>
	</ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <?= $this->Html->link(__('Nuevo usuario'), ['action' => 'addkick'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="tarifas-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($personas as $persona): ?>
                            <tr>
                                <td><?= h($persona->nombre) ?></td>
                                <td><?= h($persona->apellido) ?></td>
                                <td><?= h($persona->mail) ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">Acciones</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><?= $this->Form->postLink('Ver', ['action' => 'view', $persona->id]) ?></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                             <th>Nombre</th>
                             <th>Apellido</th>
                             <th>Email</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
