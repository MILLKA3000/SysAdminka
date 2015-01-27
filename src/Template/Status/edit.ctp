<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($status); ?>
    <fieldset>
        <legend><?= __('Edit Status') ?></legend>
        <?php
            echo $this->Form->input('name',['class'=>'form-control','type'=>'text']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
