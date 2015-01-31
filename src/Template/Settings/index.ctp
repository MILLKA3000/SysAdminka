<div class="settings index large-10 medium-9 columns">
    <?= $this->Html->link(__('Add new settings'), ['action' => 'add'],['class'=>'btn btn-success pull-right']) ?>
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>

            <th><?= $this->Paginator->sort('note') ?></th>
            <th><?= $this->Paginator->sort('value') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($settings as $setting): ?>
        <tr>
            <td><?= $this->Number->format($setting->id) ?></td>
            <td><?= h($setting->note) ?></td>
            <td><?= h($setting->value) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $setting->id],['class'=>'btn btn-warning']) ?>
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
