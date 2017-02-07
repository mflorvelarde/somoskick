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
                    <table id="example1" class="table table-bordered table-striped">
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
                    <div class="paginator">
                        <ul class="pagination">
                        <?= $this->Paginator->prev('< ' . __('previous')) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next(__('next') . ' >') ?>
                        </ul>
                        <p><?= $this->Paginator->counter() ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--
<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
	      <div class="panel-heading">
		 Listado de colegios
	      </div>
               
	      <div class="panel-body">
	         <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	              <thead>
			<tr>
			    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
			    <th><?= $this->Paginator->sort('nombre', 'Nombre') ?></th>
			    <th><?= $this->Paginator->sort('telefono', 'Telefono') ?></th>
			    <th><?= $this->Paginator->sort('direccion_id', 'Direccion') ?></th>
			    <th><?= $this->Paginator->sort('comentarios', 'Comentarios') ?></th>
			    <th><?= $this->Paginator->sort('contacto', 'Contacto') ?></th>

			    <th class="actions"><?= __('Actions') ?></th>
			</tr>
		      </thead>
		  
		      <tbody>
			  <?php foreach ($colegios as $colegio): ?>
			  <tr>
			      <td><?= $this->Number->format($colegio->id) ?></td>
			      <td><?= h($colegio->nombre) ?></td>
			      <td><?= $this->Number->format($colegio->telefono) ?></td>
			      <td><?= $this->Number->format($colegio->direccion_id) ?></td>
			      <td><?= h($colegio->comentarios) ?></td>
			      <td><?= h($colegio->contacto) ?></td>

			      <td class="actions">
			      
				  <?= $this->Html->link(__(''), ['action' => 'view', $colegio->id] , array('class' => 'fa fa-eye') ) ?>
				  <?= $this->Html->link(__(''), ['action' => 'edit', $colegio->id] , array('class' => 'fa fa-pencil') ) ?>
				  <?= $this->Form->postLink(__(''), ['action' => 'delete', $colegio->id], ['class' => 'fa fa-trash-o','confirm' => __('Are you sure you want to delete # {0}?', $colegio->id)] ) ?>
				  
			      </td>
			  </tr>		  
		      <?php endforeach; ?>
		    </tbody>
                 </table>  
                 <div class="paginator">
		    <ul class="pagination">
			<?= $this->Paginator->prev('< ' . __('previous')) ?>
			<?= $this->Paginator->numbers() ?>
			<?= $this->Paginator->next(__('next') . ' >') ?>
		    </ul>
		    <p><?= $this->Paginator->counter() ?></p>
		  
		 </div>
	      </div>
    </div>
  </div>
</div>
</div> -->