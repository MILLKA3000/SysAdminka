<div class=" col-sm-12 col-md-7 col-xs-12">
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
<div class="col-md-5 hidden-sm hidden-xs">
    <legend><?= __('Sending photo with Contingent') ?></legend>
    <?php if (file_exists(ROOT."/webroot/photo/" .$student->user_name. ".jpg")){ ?>
        <div class="row">
            <div class="col-md-5">
                <a href="/photo/<?= $student->user_name?>.jpg" data-toggle="lightbox" data-title="<?= $student->user_name?>" id="photo"></a>
                <img src="/photo/<?= $student->user_name?>.jpg" class="img-responsive thumbnail" style="max-height: 250px" id="open_photo">
            </div>
            <div class="col-md-6">
                <?= $this->Form->button(__('Send photo into google'),['class'=>'btn btn-success','id'=>'send_g','style'=>'margin: 20px 0;']) ?>
                <?= $this->Form->button(__('Delete photo in google'),['class'=>'btn btn-danger','id'=>'del_g']) ?>
            </div>
        </div>
    <?php }else{ ?>
        <img src="/img/nophoto.jpg" class="img-responsive">
    <?php } ?>
    <legend><?= __('Information with Google') ?></legend>
        <ul class="list-group" id="info_g">

        </ul>

</div>

<div class="modal fade loginModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div  style="padding: 20px">
                <h1 class="text-center text-modal">?</h1>

            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        var datag=0;
        $('[data-toggle="tooltip"]').tooltip()

        $.post( "/sync/Get_info_google/"+'<?=$student->user_name?>', function(data) {
            datag = data;
            var html='';
            $.each(data.externalIds, function(key,value){
               html = html + "<li class='list-group-item list-group-item-info'> "+value.customType+": "+value.value+"</li>";
            });
            $('#info_g').html(
                "<li class='list-group-item list-group-item-success'> fullName: "+data.setName.fullName+"</li>"+
                "<li class='list-group-item list-group-item-success'> primaryEmail: "+data.primaryEmail+"</li>"+
                "<li class='list-group-item list-group-item-success'> orgUnitPath: "+data.orgUnitPath+"</li>"+
                html+
                "<li class='list-group-item list-group-item-success'> creationTime: "+data.creationTime+"</li>"
            );
        }, "json")
            .fail(function() {
                $('#info_g').html("<li class='list-group-item list-group-item-danger'>In google this user does not exist!</li>");
        });

    $('#open_photo').click(function(){
        $('#photo').ekkoLightbox();
    });

    function modal(){
        $('.loginModal').modal({
            backdrop: 'static',
            keyboard: false
        });
    }

    function hide_modal(){
        $('.loginModal').modal('hide');
    }

   $('#send_g').click(function(){
       console.log(datag);
       if(datag!=0){
           $('.text-modal').text('Sending photo users');
           modal();
        $.post( "/sync/LDB_ToGoogle_photo/"+'<?=$student->user_name?>'+'/true', function(sync) {
            if (sync=="Ok") {
                $.post( "/students/save_google_post/"+'<?=$student->id?>', function(status) {
                    if(status=="Ok"){
                        hide_modal();
                    }
                });

            }
        });
       }else{alert('In google this user does not exist!')}
    });

    $('#del_g').click(function(){
        if(datag!=0){
        $('.text-modal').text('Deleting user photo');
        modal();
        $.post( "/sync/LDB_ToGoogle_photo_delete/"+'<?=$student->user_name?>', function(sync) {
            if (sync=="Ok") {
                $.post( "/students/delete_google_post/"+'<?=$student->id?>', function(status) {
                    if(status=="Ok"){
                        hide_modal();
                    }
                });

            }
        });
        }else{alert('In google this user does not exist!')}
    });

    });
</script>