<div class="specials index large-10 medium-9 columns">
    <?= $this->Html->link(__('Add new speciality'), ['action' => 'add'],['class'=>'btn btn-success pull-right']) ?>
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('special_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($specials as $special): ?>
        <tr>
            <td><?= $this->Number->format($special->special_id) ?></td>
            <td><?= $this->Text->autoParagraph(h($special->name))?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit',  $special->special_id],['class'=>'btn btn-warning']) ?>
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $special->special_id],['class'=>'btn btn-danger']) ?>
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
