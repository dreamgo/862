<html>
<body>

<?php
	/*connect database*/
	require('dbconnect.inc.php');
	require('create.php');
	$dbc=mysqli_connect($host,$user,$password,$database) 
		or die('fail connect database hehe');
	
	/*create table*/
	$table_name=$_POST['tableName'];
	//echo $colNum;
	/*$insert_content="xx";*/
	for($j=0;$j<$colNum;$j++){
		$type=$_POST["type".$j];
		$length=$_POST["length".$j];
		$name=$str[$j];
		
		if($type!='DATE' & $length!=NULL)
			$insert_content=$insert_content.$name."	".$type." (".$length.")";
		else
			$insert_content=$insert_content.$name."	".$type;
			
		if(isset($_POST["isNull".$j]))
			$insert_content=$insert_content." "."Not Null".",";
		else
			$insert_content=$insert_content.",";
		
		if(isset($_POST["isPrimary".$j]))
			$keys=$keys.$name.",";
	}
	
	if($keys!=NULL)	{
		$keys=rtrim($keys,",");
		$insert_priKey="CONSTRAINT pk_tmp PRIMARY KEY (".$keys.")";
		$insert_content=$insert_content.$insert_priKey;
	}
	$insert_content=rtrim($insert_content,',');
	$query="CREATE TABLE ".$table_name."(".$insert_content.")";
//	echo $query;	
	mysqli_query($dbc,$query)
		or die("fail create table:Please check your input data!");
	
	/*insert data into table*/
	$delimiter=$_POST["delimiter"];
//	echo $delimiter;
	$query2="LOAD DATA LOCAL INFILE '".$FileDestination."' into table ".$table_name." IGNORE 1 LINES";
//	echo $query2;
	mysqli_query($dbc,$query2)
		or die("**fail insert table**");
?>


</body>
</html>