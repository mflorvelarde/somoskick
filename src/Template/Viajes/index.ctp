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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?= $this->Paginator->sort('destino', 'Destino') ?></th>
                                <th class="actions"><?= __('Actions') ?></th>
                            </tr>
                        </thead>
		                <tbody>
                            <?php foreach ($viajes as $viaje): ?>
                            <tr>
                                <td><?= h($viaje->destino) ?></td>

                                <td class="actions">

                                <?= $this->Html->link(__(''), ['action' => 'view', $viaje->id] , array('class' => 'fa fa-eye') ) ?>
                                <?= $this->Html->link(__(''), ['action' => 'edit', $viaje->id] , array('class' => 'fa fa-pencil') ) ?>
                                <?= $this->Form->postLink(__(''), ['action' => 'delete', $viaje->id], ['class' => 'fa fa-trash-o','confirm' => __('Are you sure you want to delete # {0}?', $viaje->id)] ) ?>

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
</section>
