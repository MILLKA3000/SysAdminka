<div class=" col-sm-6 col-md-6 col-xs-11">
    <?= $this->Form->create($setting); ?>
    <fieldset>
        <legend><?= __('Edit Setting') ?></legend>


        <?php if (isset($setting)){?>
            <fieldset <?= $disabled ?>>
                <?= $this->Form->input('name',['class'=>'form-control','type'=>'text']); ?>
            </fieldset>

            <?= $disabled!='disabled' ? $this->Form->input('note',['class'=>'form-control']) : '';?>
            <?= $disabled!='disabled' ? $this->Form->input('type',['class'=>'form-control','options' => ['text'=>'Text Input','checkbox'=>'CheckBox','number'=>'Number input','array_email'=>'List Emails']]) : '';?>

            <?= $setting->type==null ? $this->element('/config/text',array('note' =>$setting->note)) : '' ;?>
            <?= $setting->type=='text' ? $this->element('/config/text',array('note' =>$setting->note)) : '' ;?>
            <?= $setting->type=='checkbox' ? $this->element('/config/checkbox',array('note' =>$setting->note)) : '' ;?>
            <?= $setting->type=='number' ? $this->element('/config/number',array('note' =>$setting->note)) : '' ;?>
            <?= $setting->type=='array_email' ? $this->element('/config/array_email',array('note' =>$setting->note)) : '' ;?>

            <?php
                  // echo $this->Form->input('value',['class'=>'form-control','type'=>$setting->type,'label'=>$setting->note]);
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
