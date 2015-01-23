<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($school); ?>
    <fieldset class="">
        <legend><?= __('Edit School') ?></legend>
        <?php
            echo $this->Form->input('name',['class'=>'form-control']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
