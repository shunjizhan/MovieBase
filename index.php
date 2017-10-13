<html>
<head><title>CS143 Project 1B</title></head>
<style type="text/css">
	body {
		position: relative;
		left: 20%;
		top: 100px;
		width: 60%;
		text-align: center;
		margin: 0;
		/*border: 1px solid red;*/
	}
	textarea {
		margin: 10px;
	}
	input {
		font-size: 200%;
	}
</style>
<body>

input your query here
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<textarea name="query" cols="80" rows="10"></textarea><br />
	<input type="submit" value="Submit" />
</form>

<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$query = $_REQUEST['query'];
		echo $query;
	}
?>

</body>
</html>