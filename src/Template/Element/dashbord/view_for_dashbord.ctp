<div class="col-lg-6 col-md-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Log Sync </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped" >
                    <thead>
                        <tr>
                            <th>Log</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($synchronized as $synchronized): ?>
                        <tr>
                            <td>
                                <?php foreach (json_decode($synchronized->statistics) as $k=>$stat): ?>
                                <small><?= h($k)." : ".h($stat)."<br/>" ?></small>
                                <?php endforeach; ?>

                            </td>

                            <td><?= $this->Time->nice($synchronized->date,null) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                </table>
            </div>
            <div class="text-right">
                <a href="/Synchronized/index">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

