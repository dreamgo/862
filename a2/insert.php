<html>
<head>
<script type=text/javascript>
	function alertMessage(){
		alert("Congratulation, Upload Successful!");
		history.go(-2);
	}
</script>
</head>

<body>
<?php
	/*connect database*/
	require('dbconnect.inc.php');
	$handle=fopen("$FileDestination","r") 
		or die("can't open file:ApplicationsTestFile.txt");
	/*get first line: table colum name*/
	$line=fgets($handle);
	$delimiter=$_POST["delimiter"];
	if($delimiter=='\t'){
		$str=explode("\t", $line);
	}
	else
		$str=explode($delimiter, $line);	
	$colNum=count($str);
	$colName='';		
	for($i=0;$i<$colNum;$i++){
		$colName=$colName.$str[$i].",";
	}
	
	$colName=trim($colName,',');
	$insert_content='';
	for($j=0;$j<$colNum;$j++){
		$type=$_POST["type".$j];
//		$length=$_POST["length".$j];
		if(isset($_POST['length'.$j])){$length=$_POST['length'.$j];}
		$name=$str[$j];		
		if($type=='DECIMAL')
			$type=$type."(10,2)";
		if($type=='VARCHAR')
			$type=$type."(255)";
		$insert_content=$insert_content.$name."	".$type.",";			
	}

	$insert_content="ApplicationID INT AUTO_INCREMENT,".$insert_content."PRIMARY KEY (ApplicationId)";
	

	/*connect database*/	
	$dbc=mysqli_connect($host,$user,$password,$database) 
		or die('fail connect database hehe');
	$query="DROP TABLE IF EXISTS Application";
	mysqli_query($dbc,$query)
		or die("fail drop table:please check connect of database.");
	
	/*create table*/
	$query1="CREATE TABLE Application "."(".$insert_content.")";	
	mysqli_query($dbc,$query1)
		or die("fail create table:Please check your input data!");

	/*insert other rows data into table*/
	$query2="LOAD DATA LOCAL INFILE '".$FileDestination."' into table Application  FIELDS TERMINATED by '".$delimiter."' IGNORE 1 LINES (".$colName.")" ;
	mysqli_query($dbc,$query2)
		or die("**fail insert table**");
	$query3="update Application set ApplicationID=ApplicationID-1";
	mysqli_query($dbc,$query3);
	echo "<script type=\"text/javascript\"> alertMessage(); </script>";
	
	/*close database*/
	mysqli_close($dbc);
?>


</body>
</html>