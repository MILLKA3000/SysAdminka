<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($student); ?>
    <fieldset>
        <legend><?= __('Edit Student') ?></legend>
        <?php
            echo $this->Form->input('id',['class'=>'form-control']);
            echo $this->Form->input('student_id',['class'=>'form-control','type'=>'text']);
            echo $this->Form->input('school_id', ['options' => $schools,'class'=>'form-control']);
            echo $this->Form->input('first_name',['class'=>'form-control']);
            echo $this->Form->input('last_name',['class'=>'form-control']);
            echo $this->Form->input('grade_level',['class'=>'form-control']);
            echo $this->Form->input('user_name',['class'=>'form-control']);
            echo $this->Form->input('password',['class'=>'form-control']);
            echo $this->Form->input('status_id',['options' => $status,'class'=>'form-control']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
