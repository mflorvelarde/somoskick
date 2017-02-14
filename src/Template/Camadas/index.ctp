<section class="content-header">
    <h1>Camadas</h1>
    <ol class="breadcrumb">
        <li><a href="../admin/index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Camadas</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Nueva camada'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Colegio</th>
                                <th>Camada</th>
                                <th>Vendedor</th>
                                <th>Estado</th>
                                <th>Precio actual ARS</th>
                                <th>Precio actual USD</th>
                                <th>En lista de espera</th>
                                <th>Regulares</th>
                                <th>Registrados</th>
                                <th>Por contrato</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Anunciacion De Maria</td>
                                <td>2017</td>
                                <td>Sebastian Velarde</td>
                                <td><span class="label label-success">Firmada</span></td>
                                <td>0</td>
                                <td>2600</td>
                                <td>No</td>
                                <td>18</td>
                                <td>18</td>
                                <td>20</td>
                                <td>
                                    <?php echo $this->Form->button('<i class="fa fa-align-center"></i>', array(
                                        'type' => 'button',
                                        'class' => 'btn btn-default',
                                        'action' => 'view'
                                    )); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Balmoral</td>
                                <td>2017</td>
                                <td>Sebastian Velarde</td>
                                <td><span class="label label-warning">En oferta</span></td>
                                <td>0</td>
                                <td>2600</td>
                                <td>No</td>
                                <td>18</td>
                                <td>18</td>
                                <td>20</td>
                                <td>
                                    <button type="button" class="btn btn-default"><i class="fa fa-align-center"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Balmoral</td>
                                <td>2016</td>
                                <td>Sebastian Velarde</td>
                                <td><span class="label label-danger">Perdida</span></td>
                                <td>0</td>
                                <td>2600</td>
                                <td>No</td>
                                <td>18</td>
                                <td>18</td>
                                <td>20</td>
                                <td>
                                    <button type="button" class="btn btn-default"><i class="fa fa-align-center"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Colegio</th>
                                <th>Camada</th>
                                <th>Vendedor</th>
                                <th>Estado</th>
                                <th>Precio actual ARS</th>
                                <th>Precio actual USD</th>
                                <th>En lista de espera</th>
                                <th>Regulares</th>
                                <th>Registrados</th>
                                <th>Por contrato</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

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
			      <td><?= h($camada->colegio->nombre) ?></td>
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
