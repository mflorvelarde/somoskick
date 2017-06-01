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
      <h4 class="login-box-msg" style="margin-top:10px">Para continuar, debe aceptar el contrato</h4>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12" style="margin-top:25px">
            <button class="btn btn-block btn-flat" style="background-color: #f39c12;border-color: #e08e0b; color: #fff"  onclick=location.href='<?php echo $this->Url->build(["controller" => "Grupos", "action" => "contrato"]);?>'> Ver contrato</button>
        </div>
        <?= $this->Form->create() ?>
        <div class="col-xs-12" style="margin-top:25px">
            <?= $this->Form->button('Aceptar contrato', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>
        </div>
        </form>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>


