<div class="row">
    <div class="col-lg-12">
	<h1 class="page-header">
	    Pasajeros
	</h1>
	<ol class="breadcrumb">
	    <li>
		    <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
	    </li>
	    <li class="active">
		    <i class="fa fa-user"></i> Pasajeros
	    </li>
	</ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <?= $this->Html->link(__('Nuevo Pasajero'), ['action' => 'add'] , array('class'=>'btn btn-primary') ) ?>
    </div>
</div>

<br/>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
	        <div class="panel-heading">
		        Listado de pasajeros
	        </div>
               
	        <div class="panel-body">
	            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
	                <thead>
			            <tr>
                            <th><?= $this->Paginator->sort('pasaporte', 'Pasaporte') ?></th>
                            <th><?= $this->Paginator->sort('instagram', 'Instagram') ?></th>
                            <th><?= $this->Paginator->sort('comentario', 'Comentarios') ?></th>

                            <!--	    <th><?= $this->Paginator->sort('direccion_id', 'Direccion') ?></th>
                            <th><?= $this->Paginator->sort('comentarios', 'Comentarios') ?></th>
                            <th><?= $this->Paginator->sort('contacto', 'Contacto') ?></th> -->
            			    <th class="actions"><?= __('Actions') ?></th>
			            </tr>
		            </thead>
		  
		            <tbody>
                        <?php foreach ($pasajeros as $pasajero): ?>
                            <tr>
                                <td><?= $this->Number->format($pasajero->pasaporte) ?></td>
                                <td><?= h($pasajero->instagram) ?></td>
                                <td><?= h($pasajero->comentario) ?></td>

                                <td class="actions">

                                    <?= $this->Html->link(__(''), ['action' => 'view', $pasajero->id] , array('class' => 'fa fa-eye') ) ?>
                                    <?= $this->Html->link(__(''), ['action' => 'edit', $pasajero->id] , array('class' => 'fa fa-pencil') ) ?>
                                    <?= $this->Form->postLink(__(''), ['action' => 'delete', $pasajero->id], ['class' => 'fa fa-trash-o','confirm' => __('Confirmar borrado de pasajero', $pasajero->id)] ) ?>

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
