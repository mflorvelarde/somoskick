<?= $this->Form->create($fecha_inicio) ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Fecha inicio pago</h4>
                </div>
                <div class="modal-body">
                     <div class="col-md-12" style="padding-left: 0px">
                           <div class="form-group">
                               <label>Seleccione la fecha de vencimiento del primer pago</label>
                              <?php  echo $this->Form->date('fecha_inicio',  ['required' => true, 'class' => 'form-control' ] ); ?>
                           </div>
                     </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <?= $this->Form->postLink('Ver camadas', ['action' => 'aplicartarifa' . '/' .  $tarifa->id . '/' . $camada->id]) ?>

                    <?php
                                                                                                     echo $this->Html->link(
                                                                                                         $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-trash')),
                                                                                                         '#',
                                                       array(
                                                                           'class'=>'btn btn-danger',
                                                                           'action'=> 'aplicartarifa' . '/' .  $tarifa->id . '/' . $camada->id),
                                                                    false);
                                                                                                     ?>

                    <a  class="btn btn-danger danger" onclick="irAplicarTarifa('<?php echo $tarifa->id?>','<?php echo $camada->id ?>')">Confirm</a>
                </div>
                <?= $this->Form->end() ?>