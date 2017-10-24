
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add new Actor/Director</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
<h3>Add new Actor/Director</h3>
<form method = "GET" action="add.php">
  <label for="a/d">Add:</label>
  <select name="a/d">
    <option value="Actor">Actor</option>
    <option value="Director">Director</option>
  </select>

    <div class="form-group">
      <label for="first_name">First Name</label>
      <input type="text" class="form-control" placeholder="First Name"  name="fname"/>
    </div>
    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input type="text" class="form-control" placeholder="Last Name" name="lname"/>
    </div>

    <label for="gender">Gender</label>
    <select name="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>

    <div class="form-group">
      <label for="DOB">Date of Birth</label>
      <input type="text" class="form-control" placeholder="1997-05-05" name="dateb"><br>
    </div>
    <div class="form-group">
      <label for="DOD">Date of Die</label>
      <input type="text" class="form-control" placeholder="1997-05-05" name="dated">(leave blank if alive now)<br>
    </div>
    <button type="submit" class="btn btn-default">Add!</button>
</form>

</div>
</body>
</html>

<?php
	$db = mysql_connect("localhost", "cs143", "");
	if(!$db) {
		$errmsg = mysql_error($db);
		print "Connection failed: $errmsg <br>";
		exit(1);
	}

	mysql_select_db("CS143", $db);

		$fname = $_GET["fname"];
		$lname = $_GET["lname"];
    $gender = $_GET["gender"];
		$dateb = $_GET["dateb"]; $dateb = str_replace('-', '', $dateb);
		$dated = $_GET["dated"]; $dated = str_replace('-', '', $dated);

		echo $fname, $lname, $gender, $dateb, $dated;
    $query = "INSERT INTO Actor(id,last,first,sex,dob,dod) VALUES (69999, '{$fname}', '{$lname}', '{$gender}', {$dateb}, {$dated});";
		$result = mysql_query($query, $db);

        print "<table>";

        print "<tr>";
        for($i = 0; $i < mysql_num_fields($result); $i++) {
            $field_info = mysql_fetch_field($result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        print "</tr>";

		while($row = mysql_fetch_row($result)) {
			print "<tr>";
			for($i = 0; $i < count($row); $i++) {
				print "<th>$row[$i]</th>";
			}
			print "</tr>";
		}
		print "</table>";

	mysql_close($db)
?>
