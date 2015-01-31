<div class="form-group">
    <label for="visible">Видимість тесту</label>
    <div class="block-roles">
        <?php foreach($roles as $role):?>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="role[<?php echo $role['data']['id_role']?>]" id="role-<?php echo $role['data']['id_role']?>" <?php echo (in_array($id_test,$role['open_test']))? "checked" : ""; ?> >
                    <?php echo $role['data']['title']?>
                </label>
            </div>
        <?php endforeach;?>
    </div>
</div>




