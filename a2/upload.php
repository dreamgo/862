<html>
<head>
<script type="text/javascript">
	function chkinput(){
		var file=document.getElementById("uploadFile").value;
		if(file==""){
			alert("please select a valid file!");
			return (false);
		}
		}
</script>
	
<style type="text/css">
	div{
		text-align:center;
	}
</style>
</head>

<body>
	<div>
	<form class="uploadForm" enctype="multipart/form-data" action="create.php" method="post" onsubmit="return chkinput()">   
		<h1 align="center">Upload File into database </h1>
		Please choose file: 
		<input id="uploadFile" name="data_file" type="file" >
				<label for="delimiter">Delimiter:</label>
			<select name="delimiter">
				<option value="\t">table \t</option>
				<option value="|">pipe |</option>
				<option value=":">colon :</option>
				<option value=";">semicolon ;</option>
				<option value=",">comma ,</option>
			</select> 
			<br><br><br>
		<input  type=button value=clear onclick="location.reload()">
		<input  type="submit" name="upload" value="upload" > <br> 
	</form>   
	</div>
</body>
</html>