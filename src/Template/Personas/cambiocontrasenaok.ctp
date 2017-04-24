<div class="tab-content">
    <div class="tab-pane active" role="tabpanel" id="step4">
        <div class="login-box">
            <div class="login-logo">
              <?php echo $this->Html->image('logo.png', ['alt' => 'Kick', 'style' => 'width:150px;margin-left:10%;margin-right: 10%;']);?>
            </div>
            <div class="login-box-body">
                <h3 class="login-box-msg" style="margin-top:10px; color:#d81b60">Se ha solicitado el cambio de contraseña</h4>
                <h4>Te llegará un mail a tu correo para completar la transacción</h5>
                <?= $this->Form->create() ?>
                <div class="row">
                    <div class="col-xs-12" style="margin-top:25px">
                        <?= $this->Form->button('Inicio', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>