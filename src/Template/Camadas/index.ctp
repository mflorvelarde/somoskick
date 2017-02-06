<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
	<h1 class="page-header">
	    Camadas
	</h1>
	<ol class="breadcrumb">
	    <li>
		<i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">
		<i class="fa fa-user"></i> Camadas
	    </li>
	</ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
        <?= $this->Html->link(__('Nueva camada'), ['action' => 'add'] , array('class'=>'btn btn-primary') ) ?>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
	      <div class="panel-heading">
		 Listado de camadas
	      </div>
               
	      <div class="panel-body">
	         <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	              <thead>
			<tr>
			    <th><?= $this->Paginator->sort('descripcion', 'Descripcion') ?></th>
			    <th><?= $this->Paginator->sort('año', 'Año') ?></th>
			    <th><?= $this->Paginator->sort('contacto1', 'Contacto') ?></th>
			    <th><?= $this->Paginator->sort('contacto2', 'Contacto') ?></th>

			    <th class="actions"><?= __('Actions') ?></th>
			</tr>
		      </thead>
		  
		      <tbody>
			  <?php foreach ($camadas as $camada): ?>
			  <tr>
			      <td><?= h($camada->descripcion) ?></td>
			      <td><?= $this->Number->format($camada->año) ?></td>
			      <td><?= h($camada->contacto1) ?></td>
			      <td><?= h($camada->contacto2) ?></td>

			      <td class="actions">
			      
				  <?= $this->Html->link(__(''), ['action' => 'view', $camada->id] , array('class' => 'fa fa-eye') ) ?>
				  <?= $this->Html->link(__(''), ['action' => 'edit', $camada->id] , array('class' => 'fa fa-pencil') ) ?>
				  <?= $this->Form->postLink(__(''), ['action' => 'delete', $camada->id], ['class' => 'fa fa-trash-o','confirm' => __('Confirmar borrado de camada', $camada->id)] ) ?>
				  
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
