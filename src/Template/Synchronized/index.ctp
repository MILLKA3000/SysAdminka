<div class="synchronized index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('status_contingent') ?></th>
            <th><?= $this->Paginator->sort('status_google') ?></th>
            <th><?= $this->Paginator->sort('statistics',Log) ?></th>
            <th><?= $this->Paginator->sort('date') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($synchronized as $synchronized): ?>
        <tr>
            <td><?= h($synchronized->status_contingent) ?></td>

            <td><?= h($synchronized->status_google) ?></td>

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
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
