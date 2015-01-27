<?php
error_reporting(0);
 class class_ibase_fb
{
  var $sql_login="milenium";
  var $sql_passwd="1qaz2wsxcde3";

    var $sql_host="10.1.1.250:/var/data/CONTINGENT5.FDB";
  var $conn_id;
  var $sql_query;
  var $dbh;
  var $sql_result;


public function sql_connect()
 {
 try {
		$this->dbh = ibase_connect($this->sql_host, $this->sql_login, $this->sql_passwd,"WIN1251");
	 } catch (Exception $e) {
		echo 'Помилка: ',  $e->getMessage(), "\n";
	 }

  
 }

function sql_execute()
 {
	
    $this->sql_result=ibase_query ($this->sql_query, $this->dbh);

 }

function sql_close()
 {
  ibase_close ($this->$dbh);
 }
 function select($sql)
 {	$j=0;

    $Row=array(array());
	$this->sql_connect();
    $this->sql_query=$sql;
    $this->sql_execute();
	while($Mas = ibase_fetch_row($this->sql_result))
	{
		for ($i=0;$i<count($Mas);$i++){
	   $Row[$j][$i] = $Mas[$i]; 
	   $Row[$j][$i] = iconv("windows-1251","utf-8",$Row[$j][$i]);
		
	   }
     $j++;   
       
    }
	
    return $Row;
 }
 function select2($sql)
 {	$j=0;
 $sql = iconv("utf-8","windows-1251",$sql);

    $Row=array(array());
	$this->sql_connect();	
    $this->sql_query=$sql;
    $this->sql_execute();
	while($Mas = ibase_fetch_row($this->sql_result))
	{
		for ($i=0;$i<count($Mas);$i++){
	   $Row[$j][$i] = $Mas[$i]; 
	   $Row[$j][$i] = iconv("windows-1251","utf-8",$Row[$j][$i]);
		
	   }
     $j++;   
       
    }
	
    return $Row;
 }
 function select_sql($sql)
 {	$j=1;
    $Row=array(array());
	$this->sql_connect();
    $this->sql_query=$sql;
    $this->sql_execute();
	while($Mas = ibase_fetch_assoc($this->sql_result))
	{$i=0;
		foreach($Mas  as $key => $value) {
		$Row[0][$i] = $key;
		$Row[$j][$i] = $value;
			//echo $key.": ".$value.", ";
			$i++;
		}   
	$j++; 		
    }
    return $Row;
 } 
	function for_sql($sem_v) 
	{
		for ($i=0;$i<count($sem_v);$i++)
			{
				$sem_sql=$sem_sql.$sem_v[$i];
				if($sem_v[$i+1])$sem_sql=$sem_sql.", ";
			}
	return $sem_sql;
	}
 }
 
 /*$Row = ibase_fetch_assoc ($Q);
    ibase_free_result ($Q);*/
?>