<div class=" col-sm-6 col-md-8 col-xs-11">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('id',['class'=>'form-control']);
            echo $this->Form->input('student_id',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('school_id', ['options' => $schools,'class'=>'form-control']);
            echo $this->Form->input('special_id', ['options' => $specials,'class'=>'form-control']);
            echo $this->Form->input('groupnum', ['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('first_name',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('last_name',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('grade_level',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('user_name',['class'=>'form-control','type'=>'text','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'If you editing this user name, it record will current delete on the google']);
            echo $this->Form->input('password',['class'=>'form-control']);
            echo $this->Form->input('status_id',['options' => $status,'class'=>'form-control']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>
<div class="col-md-3 hidden-sm hidden-xs">
    <legend><?= __('Photo') ?></legend>
    <?php if (file_exists(ROOT."/webroot/photo/" .$student->user_name. ".jpg")){ ?>
    <img src="/photo/<?= $student->user_name?>.jpg" class="img-responsive" style="margin-bottom: 30px;">
    <?= $this->Html->link(__('Send photo into google'),[''],['class'=>'btn btn-success','id'=>'send_g+']) ?>
    <?= $this->Html->link(__('Delete photo in google'),[''],['class'=>'btn btn-danger'],['id'=>'del_g+'],['confirm' =>'') ?>
    <?php }else{ ?>
        <img src="/img/nophoto.jpg" class="img-responsive">
    <?php } ?>


</div>

<div class="modal fade loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div  style="padding: 20px">
                <h1 class="text-center login-title">Sending photo users</h1>

            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $(function () {
        $('.loginModal').modal({
            backdrop: 'static',
            keyboard: false
        });

        $.post( "/sync/LDB_ToGoogle_photo/"+'<?=$student->user_name?>'+'/true', function(sync) {
            if (sync=="Ok") {
                $.post( "/students/save_google_post/"+'<?=$student->id?>', function(status) {
                    if(status=="Ok"){
                        $('.loginModal').modal('hide');
                    }
                });

            }
        });
    });
</script>