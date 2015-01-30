<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($user); ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('fname',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('lname',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('email',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('password',['class'=>'form-control','type'=>'text','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Only new password','value'=>'','required'=>'none']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>