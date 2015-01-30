<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Statistics
                </h1>
            </div>
        </div>
        <?= $this->element('/dashbord/info_bars');?>

        <div class="row">
            <?= $display_log_dashbord==1 ? $this->element('/dashbord/view_for_dashbord') : '';?>

            <?= $display_chart==1 ? $this->element('/dashbord/chart') : '';?>
        </div>

    </div>

</div>
