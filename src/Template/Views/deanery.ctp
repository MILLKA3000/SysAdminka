<div class=" col-sm-12 col-md-12 col-xs-12 print-only">

    <table cellpadding="0" cellspacing="0" class="table table-hover">
        <tbody>
        <?php foreach ($students as $student): ?>

            <tr>
                <td><?= __('Group') ?>: <?= $this->Text->autoParagraph(h($student['groupnum']))?></td>
                <td><?= __('First Name') ?>: <?= $this->Text->autoParagraph(h($student['first_name']))?></td>
                <td><?= __('Last Name') ?>: <?= $this->Text->autoParagraph(h($student['last_name']))?></td>
                <td><?= __('Login') ?>: <?= $this->Text->autoParagraph(h($student['user_name']))?></td>
                <td><?= __('Password') ?>: <?= $this->Text->autoParagraph(h($student['password']))?></td>


            </tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>