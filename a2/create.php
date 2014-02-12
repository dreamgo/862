<html>
<head>
<script type=text/javascript>
	function alertMessage(){
		alert("The file you upload is larger than 1M!");
		history.go(-1);
	}
</script>
</head>

<body>
<?php
	require('dbconnect.inc.php');
	//require('upload.php');
	if($_FILES["data_file"]["error"]>0){
		echo "Error:".$_FILES["data_file"]["error"]."<br>";
		exit;
	}
	if($_FILES['data_file']['size']>1024000){
		echo "<script type=\"text/javascript\"> alertMessage(); </script>";
		exit;	
	}
	else
	{
		if(!move_uploaded_file($_FILES["data_file"]["tmp_name"], $FileDestination)){
			echo "File is too large!";
			echo "*move failed!*";
			exit;
			}
			echo "Upload data file successful!<br>";
	}

?>

<form action="insert.php" method="post">
<table>
	<tr>
		<td>Name</td>
		<td>Type</td>
	</tr>

<?php
	require('dbconnect.inc.php');
	$handle=fopen("$FileDestination","r") 
		or die("can't open file:Applications.txt");
	$delimiter=$_POST["delimiter"];
	$line=fgets($handle);

	if($delimiter=='\t')
		$str=explode("\t", $line);
	else
		$str=explode($delimiter, $line);
	$colNum=count($str);

	for($i=0;$i<$colNum;$i++){
		echo "  <tr>\n";
		echo "  <td>".$str[$i]."</td>\n";
		echo "  <td>\n";
		echo "	<select name=\"type".$i."\">\n";
		echo "	<option value=\"VARCHAR\">VARCHAR</option>\";\n";
		echo "	<option value=\"DECIMAL\">DECIMAL</option>\"\n";
		echo "	<option value=\"INT\">INT</option>\";\n";
		echo "	</select>\n";
		echo "  </td>\n";
		echo "  </tr>\n";
	}
	echo "<p>Total column:".$colNum."</p>";
	fclose($handle);
?>


	<input type="hidden" name="delimiter" value="<?php echo $delimiter?>">
	<input type="submit" name="insert" value="INSERT">
</table>
</form>

</body>
</html>