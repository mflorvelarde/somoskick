<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="disabled">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-folder-open"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </span>
                            </a>
                        </li>
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-picture"></i>
                            </span>
                            </a>
                        </li>

                        <li role="presentation" class="active">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>

                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step4">
                            <div class="login-box">
                                <div class="login-logo">
                                  <a href="../../index2.html"><b>Kick</b></a>
                                </div>
                                <!-- /.login-logo -->
                                <div class="login-box-body">
                                  <h3 class="login-box-msg" style="margin-top:10px; color:#d81b60">Te registrate correctamente</h4>
                                  <h4>Te llegará un mail a tu correo para activar la cuenta</h5>
                                <?= $this->Form->create() ?>
                                  <div class="row">
                                    <!-- /.col -->
                                    <div class="col-xs-12" style="margin-top:25px">
                                        <?= $this->Form->button('Home', ['class'=>'btn bg-maroon btn-block btn-flat'] ) ; ?>
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