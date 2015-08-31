<div class="schools index large-10 medium-9 columns">
    <?= $this->Html->link(__('Add new school'), ['action' => 'add'],['class'=>'btn btn-success pull-right']) ?>
    <table cellpadding="0" cellspacing="0" class="table table-hover ui-datatable"
           data-global-search="false"
           data-length-change="false"
           data-info="true"
           data-paging="true"
           data-page-length="50">
    <thead>
        <tr>
            <th data-filterable="select" data-sortable="true" data-sort-order="2"><?= $this->Paginator->sort('school_id') ?></th>
            <th data-filterable="text" data-sortable="true" data-sort-order="2"><?= $this->Paginator->sort('name') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($schools as $school): ?>
        <tr>
            <td><?= $this->Number->format($school->school_id) ?></td>
            <td><?= $this->Text->autoParagraph(h($school->name)) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $school->id],['class'=>'btn btn-warning']) ?>
                <?= $this->Html->link(__('Delete'), ['action' => 'delete', $school->id],['class'=>'btn btn-danger']) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
