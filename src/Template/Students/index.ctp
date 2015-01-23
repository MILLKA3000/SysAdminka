<div class="students index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('school_id') ?></th>
            <th><?= $this->Paginator->sort('student_id') ?></th>
            <th><?= $this->Paginator->sort('first_name') ?></th>
            <th><?= $this->Paginator->sort('last_name') ?></th>
            <th><?= $this->Paginator->sort('user_name') ?></th>
<!--            <th>--><?//= $this->Paginator->sort('grade_level') ?><!--</th>-->
<!--            <th>--><?//= $this->Paginator->sort('password') ?><!--</th>-->
            <th><?= $this->Paginator->sort('status') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td>
                <?= $student->has('school') ? $this->Html->link($student->school->name, ['controller' => 'Schools', 'action' => 'edit', $student->school->school_id]) : '' ?>
            </td>
            <td><?= $this->Text->autoParagraph(h($student->student_id)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->first_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->last_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->user_name)); ?></td>
<!--            <td>--><?//= $student->grade_level ?><!--</td>-->
<!--            <td>--><?//= $student->password ?><!--</td>-->
            <td><? print_r($student->status_id)?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id],['class'=>'btn btn-warning']) ?>
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
