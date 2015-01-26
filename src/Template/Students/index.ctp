<div class="students index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th  class='hidden-xs hidden-sm' style='width:250px'><?= $this->Paginator->sort('school_id') ?></th>
            <th class='hidden-xs hidden-sm' style='width:200px'><?= $this->Paginator->sort('student_id') ?></th>
            <th style='width:200px'><?= $this->Paginator->sort('first_name') ?></th>
            <th style='width:200px'><?= $this->Paginator->sort('last_name') ?></th>
            <th style='width:200px'><?= $this->Paginator->sort('user_name') ?></th>
            <th style='width:200px'><?=$this->Form->input('status',[
                    'options' => $status,
                     'class'=>'form-control',
                     'style'=>'max-width:200px',
                     'onChange'=>'window.location.href = "/students/index/"+this.value',
                     'default'=>$statuses
                ]);
                ?>
            </th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td  class='hidden-xs hidden-sm'>
                <?= $student->has('school') ? $this->Html->link($student->school->name, ['controller' => 'Schools', 'action' => 'edit', $student->school->school_id]) : '' ?>
            </td>
            <td class='hidden-xs hidden-sm'><?= $this->Text->autoParagraph(h($student->student_id)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->first_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->last_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->user_name)); ?></td>
<!--            <td>--><?//= $student->grade_level ?><!--</td>-->
<!--            <td>--><?//= $student->password ?><!--</td>-->
            <td>
                <?= $student->has('status') ?  $student->status->name:'' ?>
<!--                --><?// print_r($student->status_id)?><!--</td>-->
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


