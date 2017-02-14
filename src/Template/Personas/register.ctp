<div class="container">
    <div class="row">
        <section>
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">

                        <li role="presentation" class="active">
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

                        <li role="presentation" class="disabled">
                            <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                            <span class="round-tab">
                                <i class="glyphicon glyphicon-ok"></i>
                            </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <form role="form">
                    <div class="tab-content">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                          <div class="box box-warning">
                            <div class="box-header with-border">
                              <h3 class="box-title">Datos del pasajero</h3>
                            </div>
                            <div class="box-body">
                                <!-- text input -->
                                <div class="form-group">
                                  <label>Text</label>
                                  <input type="text" class="form-control" placeholder="Enter ...">
                                </div>
                                <div class="form-group">
                                  <label>Text Disabled</label>
                                  <input type="text" class="form-control" placeholder="Enter ..." disabled>
                                </div>

                                <!-- textarea -->
                                <div class="form-group">
                                  <label>Textarea</label>
                                  <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="form-group">
                                  <label>Textarea Disabled</label>
                                  <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                                </div>

                                <!-- input states -->
                                <div class="form-group has-success">
                                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                                  <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                                  <span class="help-block">Help block with success</span>
                                </div>
                                <div class="form-group has-warning">
                                  <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with
                                    warning</label>
                                  <input type="text" class="form-control" id="inputWarning" placeholder="Enter ...">
                                  <span class="help-block">Help block with warning</span>
                                </div>
                                <div class="form-group has-error">
                                  <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                                    error</label>
                                  <input type="text" class="form-control" id="inputError" placeholder="Enter ...">
                                  <span class="help-block">Help block with error</span>
                                </div>
                                <ul class="list-inline pull-right">
                                    <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                                </ul>
                            </div>
                            </div>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step2">
                            <h3>Step 2</h3>
                            <p>This is step 2</p>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-primary next-step">Save and continue</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="step3">
                            <h3>Step 3</h3>
                            <p>This is step 3</p>
                            <ul class="list-inline pull-right">
                                <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
                                <li><button type="button" class="btn btn-default next-step">Skip</button></li>
                                <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
                            </ul>
                        </div>
                        <div class="tab-pane" role="tabpanel" id="complete">
                            <h3>Complete</h3>
                            <p>You have successfully completed all steps.</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>