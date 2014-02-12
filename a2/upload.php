<html>
<head>
	<script type="text/javascript">
	function chkinput(){
		var file=document.getElementById("uploadFile").value;
		if(file==""){
			alert("please select a valid file!");
			return (false);
		}
		return (true);
		}
	</script>
</head>
<body>
	<form enctype="multipart/form-data" action="create.php" method="post" onsubmit="return chkinput()">   
		<h1 align="center">Upload File into database </h1>
		Please choose file: 
		<br> 
		<input id="uploadFile" name="data_file" type="file"><br><br> 
		<label for="delimiter">Delimiter:</label>
			<select name="delimiter">
				<option value="\t">table \t</option>
				<option value="|">pipe |</option>
				<option value=":">colon :</option>
				<option value=";">semicolon ;</option>
				<option value=",">comma ,</option>
			</select> 
			<br>
		<input  type=button value=clear onclick="location.reload()">
		<br><br>
		<input  type="submit" name="upload" value="upload" > <br> 
	</form>   
</body>

</html>