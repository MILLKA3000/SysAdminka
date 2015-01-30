<?php if (!empty($message)) { ?>
<div class="alert alert-success alert-dismissable" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <ul>
        <?php foreach ($message as $m) { ?>
            <li><?php echo $m['message']; ?></li>
        <?php } ?>
    </ul>
</div>
<?php } ?>