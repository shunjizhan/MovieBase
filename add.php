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
