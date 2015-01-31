<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($setting); ?>
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>


        <?php if (isset($setting->type)){?>
            <fieldset <?= $disabled ?>>
                <?php
                    echo $this->Form->input('name',['class'=>'form-control','type'=>'text']);
                ?>
            </fieldset>
            <?php
                    //$setting = json_decode($setting->type,true);
                     echo $this->Form->input('note',['class'=>'form-control']);
            ?>
<!--            --><?php //if(isset($setting['name'])) echo $this->element('/config/title',array('title' =>$setting['name']));?>
<!--            --><?php //if(isset($setting['type']['count'])) echo $this->element('config/count',array('count' =>$setting['type']['count']));?>
<!--            --><?php //if(isset($setting['type']['time'])) echo $this->element('config/time',array('time' =>$setting['type']['time']));?>
<!--            --><?php //if(isset($setting['type']['rupture'])) echo $this->element('config/rupture',array('rupture' =>$setting['type']['rupture']));?>
<!--            --><?php //if(isset($setting['type']['config'])) echo $this->element('config/array',array('array' =>$setting['type']['config']));?>

            <?php
                   echo $this->Form->input('value',['class'=>'form-control','type'=>$setting->type,'label'=>$setting->note]);
            ?>
                </fieldset>
            <br/>
            <?= $this->Form->button(__('Save'),['class'=>'btn btn-success']) ?>
            <?= $this->Form->end() ?>
            <br/>
        <?php
        }
        else
        {
            echo "No configuration type array";
        }
        ?>


</div>
