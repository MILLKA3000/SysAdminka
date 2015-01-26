<div class="schools form large-10 medium-9 columns">
    <?= $this->Form->create($school); ?>
    <fieldset>
        <legend><?= __('Add School') ?></legend>
        <?php
            echo $this->Form->input('school_id',['class'=>'form-control','type'=>'text']);
        ?>
        <?php
            echo $this->Form->input('name',['class'=>'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
