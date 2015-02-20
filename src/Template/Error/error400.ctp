<style>
    .modal-backdrop.in {
        opacity: 1;
        filter: alpha(opacity=100);
    }
</style>

<?php
use Cake\Core\Configure;

if (Configure::read('debug')):
    $this->layout = 'dev_error';

    $this->assign('title', $message);
    $this->assign('templateName', 'error400.ctp');

    $this->start('file');
?>
<?php if (!empty($error->queryString)) : ?>
    <p class="notice">
        <strong>SQL Query: </strong>
        <?= h($error->queryString); ?>
    </p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
        <strong>SQL Query Params: </strong>
        <?= Debugger::dump($error->params); ?>
<?php endif; ?>
<?= $this->element('auto_table_warning') ?>
<?php
    if (extension_loaded('xdebug')):
        xdebug_print_function_stack();
    endif;

    $this->end();
endif;
?>

<div class="modal fade loginModal">
    <div class="modal-dialog " style="width:  75%">
        <div class="modal-content">
                <h1 class="text-center" style="margin: 50px 0;">
                    <?= $this->Html->image('404.png',['class'=>'img-responsive center-block']) ?>
                    <h2 class="text-center"><?= h($message) ?></h2>
                    <p class="text-center">
                        <strong><?= __d('cake', 'Error') ?>: </strong>
                        <?= sprintf(
                            __d('cake', 'The requested address %s was not found on this server.'),
                            "<strong>'{$url}'</strong>"
                        ) ?>
                        <?= $this->Html->link(__(' Home Page '), ['controller'=>'Pages','action' => 'index'],['class'=>'btn btn-success clearfix']) ?>
                    </p>
                </h1>
       </div>
    </div>
</div>

<script>

    $(function () {
        $('.loginModal').modal({
            backdrop: 'static',
            keyboard: true
        });
    });

</script>

