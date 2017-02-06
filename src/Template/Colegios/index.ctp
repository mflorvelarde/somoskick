<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
	<h1 class="page-header">
	    Usuarios
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">
		<i class="fa fa-user"></i> Usuarios
	    </li>
	</ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <?= $this->Html->link(__('Nuevo Usuario'), ['action' => 'add'] , array('class'=>'btn btn-primary') ) ?>
    </div>
</div>

<br/>

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
