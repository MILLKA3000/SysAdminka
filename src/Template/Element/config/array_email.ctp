<div class=" alert alert-info" style="margin-top: 10px;">
<label for="array"><?= $setting->note ?></label>
<table class="table">
    <?php $i=0;
        foreach(json_decode($setting->value,true) as $mas):?>
        <tr  id="tr-in-del-<?php echo $i;?>">
            <td>
                <input type="email" name="config[]" class="form-control" placeholder="" id="in-del-<?php echo $i;?>"  value="<?php echo $mas;?>">
            </td>
            <td>
                <button type="button" class="btn btn-danger delete-arr" id="del-<?php echo $i;?>">Delete</button>
            </td>
        </tr>
    <?php $i++; endforeach;  ?>

    <tr id="add">
        <td>
            <button type="button" class="add-el btn btn-default">Add</button>
        </td>
    </tr>
</table>
</div>
<script>
    var i = <?php echo $i;?>;
    function init(){
        $('.delete-arr').on('click',function(){
            var id = $(this).attr('id');
            $('#in-'+id).attr('name','');
            $('#tr-in-'+id).attr('style','display:none');
        });
    }

    $('.add-el').on('click',function(){
        var html_add = '<tr  id="tr-in-del-'+i+'">'+
            '<td>'+
            '<input type="text" name="config[]" class="form-control" placeholder="" id="in-del-'+i+'"  value="">'+
            '</td>'+
            '<td>'+
        '<button type="button" class="btn btn-danger delete-arr" id="del-'+i+'">Delete</button>'+
       '</td>'+
        '</tr>';
        $('#add').before(html_add);
        i++;
        init();
    });
    init();
</script>
