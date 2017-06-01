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


