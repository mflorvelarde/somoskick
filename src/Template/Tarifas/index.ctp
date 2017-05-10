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
                    <div class="row">
                        <div class="col-md-12">
                            <?= $this->Html->link(__('Nueva tarifa'), ['action' => 'add'] , array('class'=>'btn bg-maroon margin-bottom') ) ?>
                        </div>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Descripcion</th>
                                <th>Cantidad de cuotas</th>
                                <th>Monto en pesos</th>
                                <th>Monto en dolares</th>
                                <th></th>
                            </tr>
                              </thead>

                              <tbody>
                              <?php foreach ($tarifas as $tarifa): ?>
                              <tr>
                                  <td><?= h($tarifa->descripcion) ?></td>
                                   <td><?= $this->Number->format($tarifa->cantidad_cuotas) ?></td>
                                 <td><?= $this->Number->format($tarifa->monto_pesos) ?></td>
                                  <td><?= $this->Number->format($tarifa->monto_dolares) ?></td>


                                  <td class="actions">
                                      <div class="btn-group">
                                          <button type="button" class="btn btn-default">Acciones</button>
                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                              <span class="caret"></span>
                                              <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                              <li><?= $this->Html->link('Ver tarifa', ['action' => 'view', $tarifa->id]) ?></li>
                                              <li><?= $this->Html->link('Aplicar a grupos', ['action' => 'aplicarGrupos', $tarifa->id]) ?></li>
                                              <li><?= $this->Form->postLink('Borrar tarifa', ['action' => 'delete', $tarifa->id], ['confirm' => __('Confirmar borrado de tarifa', $tarifa->id)] ) ?></li>
                                          </ul>
                                      </div>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                            </tbody>
                                                    <tfoot>
                                                        <tr>
                                <th>Descripcion</th>
                                <th>Cantidad de cuotas</th>
                                <th>Monto en pesos</th>
                                <th>Monto en dolares</th>
                                <th></th>
                                                        </tr>
                                                    </tfoot>
                                 </table>

		 </div>
	      </div>
    </div>
  </div>
</div>



<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>