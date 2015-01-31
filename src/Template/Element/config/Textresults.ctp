
<div class="form-group">

<?php
	if (!empty($Textresults)){
		$i=0;
        $j=0;

?>
        <label>Налаштування повідомлень про результати</label><br>
<?php	foreach($Textresults as $Textresult){
		if($Textresult['Textresult']['id_test']==$id_test){
            if($i==0){$show=$Textresult['Textresult']['feature'];}
            if($show<>$Textresult['Textresult']['feature']){
                $show=$Textresult['Textresult']['feature'];
                $j=0;
            }
            ?>
		<div class='resultbox'>
            <label> <?php echo $testFeature['title'][$Textresult['Textresult']['feature']];?></label><br>
            <label>Межі оцінювання: <?php echo "[ ".$limits[$Textresult['Textresult']['feature']][0]." , ".$limits[$Textresult['Textresult']['feature']][1]." ]";?> </label><br>
			<label>Результат <?php echo $j+1;?> <br>  Оцінка в інтервалі:
                <?php if($j==0){
                            $interval="[ ".$limits[$Textresult['Textresult']['feature']][0]." , ";
                        }
                        else {
                            $interval="[ ".$intervals[$Textresult['Textresult']['feature']][$j-1]." , ";
                        }
                        if($j==count($intervals[$Textresult['Textresult']['feature']])){
                            $interval=$interval.$limits[$Textresult['Textresult']['feature']][1]." ]";
                        }
                        else {
                            $interval=$interval.$intervals[$Textresult['Textresult']['feature']][$j]." )";
                        }
                    if(isset($interval)){echo $interval;}
                ?>
            </label><br>
			<label>Коротке повідомлення</label>
            <input name="results[<?php echo $i;?>]" value="<?php echo $Textresult['Textresult']['id_textresult']?>" style="display:none;">
			<input type="text" name="shortresult[<?php echo $i;?>]" class="form-control" value=" <?php echo $Textresult['Textresult']['shortresult']; ?> ">
			<br>
			<label>Довге повідомлення</label>
			<textarea class="form-control" name="longresult[<?php echo $i;?>]" rows="4"><?php echo $Textresult['Textresult']['longresult']; ?></textarea>
			
		</div>
		<?php
            $i++;
            $j++;
		}

		}
	 }else{
		echo 'Перелік результатів не додано';
	 }
 ?>
 
 </div>