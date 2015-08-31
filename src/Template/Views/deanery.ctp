<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($view); ?>
    <fieldset>
        <legend>Export for Deanery</legend>
        <?php
        echo $this->Form->input('school_id', ['options' => $schools,'class'=>'form-control']);
        echo $this->Form->input('special_id', ['options' => $specials,'class'=>'form-control']);
        echo $this->Form->input('status_id',['options' => $status,'class'=>'form-control']);
        echo $this->Form->input('grade_level',['options' =>[
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            '11' => '11',
            '12' => '12'
        ],'class'=>'form-control','label'=>'Semester']);
        ?>
    </fieldset>
    <br/>
    <?= $this->Form->button(__('Download'),['class'=>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
    <br/>
</div>
