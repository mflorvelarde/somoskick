<script type="text/javascript">

jQuery( document ).ready(function()
{
   jQuery('#destionas-table').dynatable();
});
</script>
<section class="content-header">
    <h1 class="page-header">
        Viajes
    </h1>
    <ol class="breadcrumb">
        <li>
        <i class="fa fa-wrench"></i>  <a href="index.html">Administraci&oacute;n</a>
        </li>
        <li class="active">Viajes</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $this->Html->link(__('Nuevo viaje'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="destionas-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Destino</th>
                                <th></th>
                            </tr>
                        </thead>
		                <tbody>
                            <?php foreach ($viajes as $viaje): ?>
                            <tr>
                                <td><?= h($viaje->destino) ?></td>

                                <td class="actions">
                                <div class="btn-group">
                                      <button type="button" class="btn btn-default">Acciones</button>
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                          <span class="caret"></span>
                                          <span class="sr-only">Toggle Dropdown</span>
                                      </button>
                                      <ul class="dropdown-menu" role="menu">
                                          <li><?= $this->Html->link('Editar viaje', ['action' => 'edit', $viaje->id] ) ?></li>
                                          <li><?= $this->Form->postLink('Borrar viaje', ['action' => 'delete', $viaje->id], ['confirm' => __('Confirmar borrado de viaje', $viaje->id)] ) ?></li>
                                      </ul>
                                  </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Destino</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
	            </div>
            </div>
        </div>
    </div>
</section>
