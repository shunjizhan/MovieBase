
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add New Actor/Director</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
    <h3>Add New Movie</h3>
    <form method="GET" action="#">
        <div class="form-group">
          <label for="title">Title:</label>
          <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
          <label for="company">Company</label>
          <input type="text" class="form-control" name="company">
        </div>
        <div class="form-group">
          <label for="year">Year</label>
          <input type="text" class="form-control" name="year">
        </div>
        <div class="form-group">
            <label for="rating">MPAA Rating</label>
            <select class="form-control" name="rate">
                <option value="G">G</option>
                <option value="NC-17">NC-17</option>
                <option value="PG">PG</option>
                <option value="PG-13">PG-13</option>
                <option value="R">R</option>
                <option value="surrendere">surrendere</option>
            </select>
        </div>
        <div class="form-group">
            <label >Genre:</label>
            <input type="checkbox" name="genre[]" value="Action">Action</input>
            <input type="checkbox" name="genre[]" value="Adult">Adult</input>
            <input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
            <input type="checkbox" name="genre[]" value="Animation">Animation</input>
            <input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
            <input type="checkbox" name="genre[]" value="Crime">Crime</input>
            <input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
            <input type="checkbox" name="genre[]" value="Drama">Drama</input>
            <input type="checkbox" name="genre[]" value="Family">Family</input>
            <input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
            <input type="checkbox" name="genre[]" value="Horror">Horror</input>
            <input type="checkbox" name="genre[]" value="Musical">Musical</input>
            <input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
            <input type="checkbox" name="genre[]" value="Romance">Romance</input>
            <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
            <input type="checkbox" name="genre[]" value="Short">Short</input>
            <input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
            <input type="checkbox" name="genre[]" value="War">War</input>
            <input type="checkbox" name="genre[]" value="Western">Western</input>
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

		$title = $_GET["title"];
		$company = $_GET["company"];
    $year = $_GET["year"];
		$rate = $_GET["rate"];
		$dated = $_GET["dated"];
    $genre = "";

    foreach($_GET["genre"] as $g) {
      $genre .= $g;
    }

		echo "$title $company $year $rate $dated $genre";
		// $result = mysql_query($query, $db);
		//
    //     print "<table>";
		//
    //     print "<tr>";
    //     for($i = 0; $i < mysql_num_fields($result); $i++) {
    //         $field_info = mysql_fetch_field($result, $i);
    //         echo "<th>{$field_info->name}</th>";
    //     }
    //     print "</tr>";
		//
		// while($row = mysql_fetch_row($result)) {
		// 	print "<tr>";
		// 	for($i = 0; $i < count($row); $i++) {
		// 		print "<th>$row[$i]</th>";
		// 	}
		// 	print "</tr>";
		// }
		// print "</table>";

	mysql_close($db)
?>
