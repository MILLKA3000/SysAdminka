<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 col-md-4  col-xs-4 col-sm-4">
                        <div class="huge"><?= isset($data['new_student']) ? $data['new_student'] : '0'; ?></div>
                        <div>New Students</div>
                    </div>
                    <div class="col-xs-9 col-md-5  col-xs-5 col-sm-5">
                        <div class="huge"><?= isset($data['rename_student']) ? $data['rename_student'] : '0'; ?></div>
                        <div>Rename Students</div>
                    </div>
                </div>
            </div>
            <a href="/Students/index/">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-xs-9 col-md-4 col-xs-4 col-sm-4">
                        <div class="huge"><?= isset($data['new_employees']) ? $data['new_employees'] : '0'; ?></div>
                        <div>New Peoples </div>
                    </div>
                    <div class="col-xs-9 col-md-5 col-xs-5 col-sm-5">
                        <div class="huge"><?= isset($data['rename_employees']) ? $data['rename_employees'] : '0'; ?></div>
                        <div>Rename Peoples </div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-archive fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($data['archive_students']) ? $data['archive_students'] : '0'; ?></div>
                        <div>Students in Archive!</div>
                    </div>
                </div>
            </div>
            <a href="/Students/index/10">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-warning fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= isset($data['conflict_students']) ? $data['conflict_students'] : '0'; ?></div>
                        <div>Conflicts!</div>
                    </div>
                </div>
            </div>
            <a href="/Students/index/3">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>