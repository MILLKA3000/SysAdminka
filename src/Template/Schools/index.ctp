<div class="schools index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('school_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($schools as $school): ?>
        <tr>
            <td><?= $this->Number->format($school->school_id) ?></td>
            <td><?= $this->Text->autoParagraph(h($school->name)) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $school->school_id],['class'=>'btn btn-warning']) ?>
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $school->school_id],['class'=>'btn btn-danger']) ?>
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
