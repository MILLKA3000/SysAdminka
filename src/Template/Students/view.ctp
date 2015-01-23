<div class="students view large-10 medium-9 columns">
    <h2><?= h($student->student_id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('School') ?></h6>
            <p><?= $student->has('school') ? $this->Html->link($student->school->school_id, ['controller' => 'Schools', 'action' => 'view', $student->school->school_id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($student->id) ?></p>
            <h6 class="subheader"><?= __('Grade Level') ?></h6>
            <p><?= $this->Number->format($student->grade_level) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= $this->Number->format($student->password) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Student Id') ?></h6>
            <?= $this->Text->autoParagraph(h($student->student_id)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('First Name') ?></h6>
            <?= $this->Text->autoParagraph(h($student->first_name)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Last Name') ?></h6>
            <?= $this->Text->autoParagraph(h($student->last_name)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('User Name') ?></h6>
            <?= $this->Text->autoParagraph(h($student->user_name)); ?>

        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Status') ?></h6>
            <?= $this->Text->autoParagraph(h($student->status)); ?>

        </div>
    </div>
</div>
