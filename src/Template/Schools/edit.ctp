<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($school); ?>
    <fieldset class="">
        <legend><?= __('Edit School') ?></legend>
        <fieldset <?= $disabled ?>>
            <?php
                echo $this->Form->input('school_id',['class'=>'form-control','type'=>'text']);
            ?>
        </fieldset>
        <?php
            echo $this->Form->input('name',['class'=>'form-control']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Save'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>
