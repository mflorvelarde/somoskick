<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="disabled">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Pasajero">
                                <span class="round-tab"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Padre / Tutor">
                                <span class="round-tab"><i class="fa fa-male" aria-hidden="true"></i></span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Madre / Tutora">
                                <span class="round-tab"><i class="fa fa-female" aria-hidden="true"></i></span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Medio de pago">
                                <span class="round-tab"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step4">
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
                                  <h3 class="login-box-msg" style="margin-top:10px; color:#d81b60">Te registrate correctamente</h4>
                                  <h4>Te llegará un mail a tu correo para activar la cuenta</h5>
                                <?= $this->Form->create() ?>
                                  <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-12" style="margin-top:25px">
                                        <?= $this->Form->button('Inicio', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>
                                    </div>
                                    <!-- /.col -->
                                  </div>
    </form>

                              </div>
                              <!-- /.login-box-body -->
                            </div>

                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>
        </section>
    </div>
</div>