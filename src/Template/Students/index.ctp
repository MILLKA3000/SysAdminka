<div id="animation">
    <div class="circle"></div>
    <div class="circle1"></div>
</div>

<div class="data" style="display:none">


    <div class="row">
<!--        <div class="col-sm-6 col-md-6 col-xs-6">-->
<!--            <div class="row">-->
<!--                <div class="col-sm-10 col-md-6 col-xs-9">-->
<!--                    --><?php // $this->Form->input('',['class'=>'form-control search_sort','type'=>'text','label' => false,'value'=>$search]); ?>
<!--                </div>-->
<!--                <div class="col-sm-1 col-md-1 col-xs-1">-->
<!--                    <button class="btn btn-default" type="button" onClick='window.location.href = "/students/index/"+$(".change_sort").val()+"/"+$(".search_sort").val()'><i class="fa fa-search"></i></button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <div class="col-sm-12 col-md-12 col-xs-12 text-left">
            <?= $this->Html->link(__('Synchronization'), ['controller'=>'Sync','action' => 'contingent'],['class'=>'btn btn-success pull-right']) ?>
            <br>
        </div>
    </div>
    <table
        class="table table-striped table-bordered table-hover ui-datatable"
        data-global-search="false"
        data-length-change="false"
        data-info="true"
        data-paging="true"
        data-page-length="50"
        >
        <thead>
        <tr>
            <th style="max-width:120px" data-filterable="text" class='col-xs-2 hidden-xs hidden-sm' data-sortable="true">Department</th>
            <th style="max-width:120px" data-filterable="text" class='col-xs-2 hidden-xs hidden-sm' data-sortable="true" data-sort-order="2">Special</th>
            <th style="max-width:10px" class='col-xs-1 hidden-xs hidden-sm' data-filterable="select" data-sortable="true" data-sort-order="2">Sem</th>
            <th style="max-width:120px" class='hidden-xs hidden-sm' data-filterable="text" data-sortable="true" data-sort-order="2">Student_id</th>
            <th style="max-width:10px" class='col-xs-1 hidden-xs hidden-sm' data-filterable="select" data-sortable="true" data-sort-order="2">Group</th>
            <th style="max-width:50px" data-filterable="text" data-sortable="true" data-sort-order="2">First_name</th>
            <th style="max-width:50px" data-filterable="text" data-sortable="true" data-sort-order="2">Last_name</th>
            <th style="max-width:50px" data-filterable="text" data-sortable="true" data-sort-order="2">User_name</th>
            <th style="max-width:40px" data-filterable="select" data-sortable="true" data-sort-order="2">Status</th>
            <th style="max-width:20px">Edit</th>
        </tr>
        </thead>
        <tbody>

    <?php foreach ($students as $student): ?>
        <tr <?= $viev_photo_students==1 ? ' class="popover_students" data-toggle="popover" img="'.$student->user_name.'" ' : '' ?>>

            <td  class='hidden-xs hidden-sm'>
                <?= $student->has('school') ? $this->Html->link($student->school->name, ['controller' => 'Schools', 'action' => 'edit', $student->school->id]) : '' ?>
            </td>
            <td  class='hidden-xs hidden-sm'>
                <?= $student->has('special') ? $this->Html->link($student->special->name, ['controller' => 'Specials', 'action' => 'edit', $student->special->special_id]) : '' ?>
            </td>
            <td class='hidden-xs hidden-sm'><?= $student->grade_level ?></td>
            <td class='hidden-xs hidden-sm'><?= $this->Text->autoParagraph(h($student->student_id)); ?></td>
            <td class='hidden-xs hidden-sm'><?= $student->groupnum ?></td>
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
<!--    <div class="paginator">-->
<!--        <ul class="pagination">-->
<!--            --><?php // $this->Paginator->prev('< ' . __('previous')) ?>
<!--            --><?php //$this->Paginator->numbers() ?>
<!--            --><?php //$this->Paginator->next(__('next') . ' >') ?>
<!--        </ul>-->
<!--        <p>--><?php //$this->Paginator->counter() ?><!--</p>-->
<!--    </div>-->
</div>

<script>

    $(document).ready(function(){

    $('.data').show();
    $('#animation').hide();

    $('.data .table .form-control').attr('style','max-width:120px');
    $('.table').on('mouseenter', '.popover_students', function() {
        $(this).popover({placement: 'left', content: '<img src="/photo/'+$(this).attr('img')+'.jpg" class="img-responsive" style="max-height:150px">', html: true})
        $(this).popover('show');
    });
    $('.table').on('mouseleave', '.popover_students', function() {
        $(this).popover('hide');
    });

    });
</script>
