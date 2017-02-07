



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
		 Listado de Personas
	      </div>
               
	      <div class="panel-body">
	         <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	              <thead>
			<tr>
			    <th><?= $this->Paginator->sort('id', 'ID') ?></th>
			    <th><?= $this->Paginator->sort('nombre', 'NOMBRE') ?></th>
			    <th><?= $this->Paginator->sort('apellido', 'APELLIDO') ?></th>

			    <th class="actions"><?= __('Actions') ?></th>
			</tr>
		      </thead>
		  
		      <tbody>
			  <?php foreach ($cuotas as $cuota): ?>
			  <tr>
			      <td><?= $this->Number->format($cuota->id) ?></td>
			      <td><?= $this->Number->format($cuota->monto_pesos) ?></td>
			      <td><?= $this->Number->format($cuota->monto_dolares) ?></td>

			        <?php foreach ($cuota->cuotas_aplicada as $cuotas_aplicada): ?>
			        <td><?= $this->Number->format($cuotas_aplicada->id) ?></td>


		      <?php endforeach; ?>


			      <td class="actions">
			      
				  <?= $this->Html->link(__(''), ['action' => 'view', $cuota->id] , array('class' => 'fa fa-eye') ) ?>
				  <?= $this->Html->link(__(''), ['action' => 'edit', $cuota->id] , array('class' => 'fa fa-pencil') ) ?>
				  <?= $this->Form->postLink(__(''), ['action' => 'delete', $cuota->id], ['class' => 'fa fa-trash-o','confirm' => __('Are you sure you want to delete # {0}?', $cuota->id)] ) ?>
				  
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
