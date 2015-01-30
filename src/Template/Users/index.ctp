<div class="users index large-10 medium-9 columns">
    <?= $this->Html->link(__('Add new user'), ['action' => 'add'],['class'=>'btn btn-success pull-right']) ?>
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('fname') ?></th>
            <th><?= $this->Paginator->sort('lname') ?></th>
            <th><?= $this->Paginator->sort('email') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $this->Number->format($user->id) ?></td>
            <td><?= h($user->fname) ?></td>
            <td><?= h($user->lname) ?></td>
            <td><?= h($user->email) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id],['class'=>'btn btn-warning']) ?>
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $user->id],['class'=>'btn btn-danger']) ?>
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
