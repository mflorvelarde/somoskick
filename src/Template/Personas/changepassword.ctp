<div class="login-box">
    <div class="login-logo" style="height: 150px;">
           <div class="col-sm-6"><img src="/img/logo.png" alt="Kick" style="
                    float: left;
                    max-height: 148px;
                    max-width: 90%;
                    /* margin-left: 10%; */
                    /* margin-right: 10%; */
                    ">       </div>
           <div class="col-sm-6"><img src="/img/jumplogo.png" alt="Kick" style="
                                float: left;
                                max-height: 120px;
                                max-width: 90%;
                                /* margin-left: 10%; */
                                /* margin-right: 10%; */
                                /* margin-top: 15px; */
                                ">
           </div>
    </div>
    <div class="login-box-body">
      <h4 class="login-box-msg" style="margin-top:10px">Por favor, complete los campos para generar una nueva contraseña</h4>
    <?= $this->Form->create() ?>
      <div class="form-group has-feedback" style="margin-top:20px">
             <div><label style="color:#fff">Contraseña</label></div>
            <?= $this->Form->input('contrasena', ['class'=>'form-control', 'placeholder'=>'Contraseña' , 'name'=>'contrasena', 'label' => '','type'=>'password', 'autofocus'] ) ?>
      </div>
      <div class="form-group has-feedback">
             <div><label style="color:#fff">Repita su contraseña</label></div>
            <?= $this->Form->input('chequeo', ['class'=>'form-control', 'placeholder'=>'Confirmar contraseña', 'name'=>'chequeo', 'label' => '','type'=>'password', 'value'=>'']) ?>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12" style="margin-top:25px">
            <?= $this->Form->button('Ingresar', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>

        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>


