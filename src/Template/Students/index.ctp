<div class="">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-xs-6">
            <div class="row">
                <div class="col-sm-10 col-md-6 col-xs-9">
                    <?= $this->Form->input('',['class'=>'form-control search_sort','type'=>'text','label' => false,'value'=>$search]); ?>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-1">
                    <button class="btn btn-default" type="button" onClick='window.location.href = "/students/index/"+$(".change_sort").val()+"/"+$(".search_sort").val()'><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xs-6">
            <?= $this->Html->link(__('Synchronized with Contingent'), ['controller'=>'Sync','action' => 'contingent'],['class'=>'btn btn-success pull-right']) ?>
        </div>
    </div>
    <table cellpadding="0" cellspacing="0" class="table table-hover">
    <thead>
        <tr>
            <th  class='hidden-xs hidden-sm' style='width:150px'><?= $this->Paginator->sort('school_id','Department') ?></th>
            <th  class='hidden-xs hidden-sm' style='width:150px'><?= $this->Paginator->sort('special_id','Special') ?></th>
            <th class='hidden-xs hidden-sm' style='width:20px'><?= $this->Paginator->sort('grade_level','Semester') ?></th>
            <th class='hidden-xs hidden-sm' style='width:50px'><?= $this->Paginator->sort('student_id') ?></th>
            <th class='hidden-xs hidden-sm' style='width:20px'><?= $this->Paginator->sort('groupnum') ?></th>
            <th style='width:150px'><?= $this->Paginator->sort('first_name') ?></th>
            <th style='width:150px'><?= $this->Paginator->sort('last_name') ?></th>
            <th style='width:150px'><?= $this->Paginator->sort('user_name') ?></th>

            <th style='width:200px'><?= $this->Form->input('status',[
                    'options' => $status,
                     'class'=>'form-control change_sort',
                     'style'=>'max-width:200px',
                     'onChange'=>'window.location.href = "/students/index/"+this.value+"/"+$(".search_sort").val()',
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
                <?= $student->has('school') ? $this->Html->link($student->school->name, ['controller' => 'Schools', 'action' => 'edit', $student->school->id]) : '' ?>
            </td>
            <td  class='hidden-xs hidden-sm'>
                <?= $student->has('special') ? $this->Html->link($student->special->name, ['controller' => 'Specials', 'action' => 'edit', $student->special->special_id]) : '' ?>
            </td>
            <td class='hidden-xs hidden-sm'><?= $this->Text->autoParagraph(h($student->grade_level)); ?></td>
            <td class='hidden-xs hidden-sm'><?= $this->Text->autoParagraph(h($student->student_id)); ?></td>
            <td class='hidden-xs hidden-sm'><?= $this->Text->autoParagraph(h($student->groupnum)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->first_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->last_name)); ?></td>
            <td><?= $this->Text->autoParagraph(h($student->user_name)); ?></td>
            <td>
                <?= $student->has('status') ?  $student->status->name:'' ?>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->id],['class'=>'btn btn-warning']) ?>
                <?= $student->status_id==10 ? $this->Html->link(__('Delete'), ['action' => 'delete', $student->id],['class'=>'btn btn-danger']): ''?>

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


