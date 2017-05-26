<div class="login-box">
    <div class="login-logo" style="height: 150px;">
       <div class="col-sm-6"><?php echo $this->Html->image('logo.png', ['alt' => 'Kick',
            'style' =>

                'float: left;
                width: 100%;
                margin-left: 10%;
                margin-right: 10%;'
            ]);?>
       </div>
       <div class="col-sm-6"><?php echo $this->Html->image('jumplogo.png', ['alt' => 'Kick',
            'style' => 'float: left;
                            width: 96%;
                            margin-left: 10%;
                            margin-right: 10%;
                            margin-top: 15px;']);?></div>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <h4 class="login-box-msg" style="margin-top:10px">Inicia sesión para ingresar</h4>
    <?= $this->Form->create() ?>
      <div class="form-group has-feedback" style="margin-top:20px">
             <div><label style="color:#fff">Mail</label></div>
            <?= $this->Form->input('c', ['class'=>'form-control', 'placeholder'=>'Mail' , 'name'=>'mail', 'label' => '','type'=>'mail', 'autofocus'] ) ?>
      </div>
      <div class="form-group has-feedback">
             <div><label style="color:#fff">Contraseña</label></div>
            <?= $this->Form->input('contrasena', ['class'=>'form-control', 'placeholder'=>'Contraseña', 'name'=>'contrasena', 'label' => '','type'=>'password', 'value'=>'']) ?>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12" style="margin-top:25px">
            <?= $this->Form->button('Ingresar', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>

        </div>
        <!-- /.col -->
      </div>
    </form>
    <div id="labels" style="margin-top:15%">
    <a href="../personas/cambiarcontrasena">Olvidé mi contraseña</a><br>
    <a href="../pasajeros/registrarse" class="text-center">Registrarse</a>
    </div>
  </div>
  <!-- /.login-box-body -->
</div>


