<html>
<body>
<?php
	require('dbconnect.inc.php');
	require('upload.php');
	if($_FILES["data_file"]["error"]>0)
	{
		echo "Error:".$_FILES["data_file"]["error"]."<br>";
	}
	else
	{
		echo "Upload data file successful!<br>";
		if(!move_uploaded_file($_FILES["data_file"]["tmp_name"], $FileDestination))
			echo "*move failed!*";
	}

?>
<form action="insert.php" method="post">
<label for="tableName">Table name: </label><input name="tableName" type="text">
<label for="delimiter">Delimiter:</label>
<select name="delimiter">
<option value="\t">table \t</option>
<option value="\|">pipe |</option>
<option value="\:">colon :</option>
<option value="\;">semicolon ;</option>
<option value="\,">comma ,</option>
</select>
<table>
	<tr>
		<td>Name</td>
		<td>Type</td>
		<td>Length</td>
		<td>NOT NULL</td>
		<td>Primary</td>
	</tr>

<?php
require('dbconnect.inc.php');
$handle=fopen("$FileDestination","r") 
	or die("can't open file:Applications.txt");
	
$line=fgets($handle);
$str=explode("\t", $line);
$colNum=count($str);
//echo $colNum;
for($i=0;$i<$colNum;$i++){
	echo "  <tr>\n";
	echo "  <td>".$str[$i]."</td>\n";
	echo "  <td>\n";
	echo "	<select name=\"type".$i."\">\n";
	echo "	<option value=\"VARCHAR\">VARCHAR</option>\";\n";
	echo "	<option value=\"DOUBLE\">DOUBLE</option>\"\n";
	echo "	<option value=\"INT\">INT</option>\";\n";
	echo "	<option value=\"DATE\">DATE</option>\";\n";
	echo "	<option value=\"CHAR\">CHAR</option>\";\n";
	echo "	<option value=\"TEXT\">TEXT</option>\";\n";
	echo "	</select>\n";
	echo "  </td>\n";
	echo "  <td><input type=\"text\" name=\"length".$i."\"></td>\n";
	echo "  <td><input type=\"checkbox\" name=\"isNull".$i."\"></td>\n";
	echo "  <td><input type=\"checkbox\" name=\"isPrimary".$i."\"></td>\n";
	echo "  </tr>\n";
}

echo "<p>Total column:".$colNum."</p>";
fclose($handle);
?>
</table>
<input type="submit" name="insert" value="INSERT">
</form>

</body>
</html>