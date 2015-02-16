<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($view); ?>
    <fieldset>
        <legend>Download all photo of students</legend>

    </fieldset>
    <br/>
    <?= $this->Form->button(__('Download'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>