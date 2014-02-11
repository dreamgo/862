<html>
<body>

<?php
	/*connect database*/
	require('dbconnect.inc.php');
//	require('create.php');
	$handle=fopen("$FileDestination","r") 
		or die("can't open file:Applications.txt");
	
	$line=fgets($handle);
	$str=explode("\t", $line);
	$colNum=count($str);		
	//echo $colNum;
	/*$insert_content="xx";*/	
	for($j=0;$j<$colNum;$j++){
		$type=$_POST["type".$j];
		$length=$_POST["length".$j];
		$name=$str[$j];		
		if($type=='VARCHAR')
			$type=$type."(255)";
		$insert_content=$insert_content.$name."	".$type.",";			
	}	
	$insert_content=rtrim($insert_content,',');
	
	$dbc=mysqli_connect($host,$user,$password,$database) 
		or die('fail connect database hehe');
	$query="DROP TABLE IF EXISTS application";
	mysqli_query($dbc,$query);
	$query1="CREATE TABLE application "."(".$insert_content.")";
//	echo $query1;	
	mysqli_query($dbc,$query1)
		or die("fail create table:Please check your input data!");
	
	/*insert data into table*/
	$delimiter=$_POST["delimiter"];
//	echo $delimiter;
	$query2="LOAD DATA LOCAL INFILE '".$FileDestination."' into table application IGNORE 1 LINES";
//	echo $query2;
	mysqli_query($dbc,$query2)
		or die("**fail insert table**");
	echo "Congratulation, Upload Successful!"
?>


</body>
</html>