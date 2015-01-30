<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($special); ?>
    <fieldset>
        <legend><?= __('Edit Special') ?></legend>
        <fieldset <?= $disabled ?>>
            <?php
                echo $this->Form->input('special_id',['class'=>'form-control','type'=>'text']);
            ?>
        </fieldset>
        <?php
            echo $this->Form->input('name',['class'=>'form-control','type'=>'text']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Submit'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>
