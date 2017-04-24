<div class="login-box">
    <div class="login-logo">
      <?php echo $this->Html->image('logo.png', ['alt' => 'Kick', 'style' => 'width:150px;margin-left:10%;margin-right: 10%;']);?>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <h4 class="login-box-msg" style="margin-top:10px">Por favor, ingrese su correo electrónico para solicitar un cambio de contraseña</h4>
    <?= $this->Form->create() ?>
       <p style="color: orangered; text-align: center;"> <?= h($mensaje)?></p>
      <div class="form-group has-feedback" style="margin-top:20px">
             <div><label style="color:#fff">Email</label></div>
            <?= $this->Form->input('mail', ['class'=>'form-control', 'placeholder'=>'Email' , 'name'=>'mail', 'label' => '','type'=>'email', 'autofocus'] ) ?>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12" style="margin-top:25px">
            <?= $this->Form->button('Solicitar cambio de contraseña', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>

        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>


