<html>
<body>
	<form enctype="multipart/form-data" action="create.php" method="post">   
		<h1 align="center">Upload File into database </h1>
		<p align="center">Please choose file:</p> <br> 
		<input  name="data_file" type="file"><br> 
		<label for="delimiter">Delimiter:</label>
			<select name="delimiter">
				<option value="\t">table \t</option>
				<option value="|">pipe |</option>
				<option value=":">colon :</option>
				<option value=";">semicolon ;</option>
				<option value=",">comma ,</option>
			</select> 
		<input type=button value=clear onclick="location.reload()">
		<input  type="submit" name="upload" value="upload"> <br> 
	</form>   
</body>
</html>