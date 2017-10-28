
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add New Movie Actor Relation</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
    <form method="GET" action="#">
        <div class="form-group">
          <label for="title">Movie Title:</label>
              <?php
              	$db = mysql_connect("localhost", "cs143", "");
              	if(!$db) {
              		$errmsg = mysql_error($db);
              		print "Connection failed: $errmsg <br>";
              		exit(1);
              	}

              	mysql_select_db("CS143", $db);

                $sql=mysql_query("SELECT title, year FROM Movie");
                if(mysql_num_rows($sql)){
                $select= '<select class="form-control" name="title">';
                while($rs=mysql_fetch_array($sql)){
                      $select.='<option value="">'.$rs['title'].'   ['.$rs['year'].']'.'</option>';
                  }
                }
                $select.='</select>';
                echo $select;
                ?>
        </div>
        <div class="form-group">
          <label for="actor">Actor</label>
          <input type="text" class="form-control" name="actor">
        </div>
        <div class="form-group">
          <label for="role">Role</label>
          <input type="text" class="form-control" name="role">
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
		$actor = $_GET["actor"];
    $role = $_GET["role"];

		echo "$title $actor $role";
    //get the largest id number
    $rowSQL = mysql_query("SELECT MAX(id) AS max FROM MaxMovieID;");
    $row = mysql_fetch_array($rowSQL);
    $largestNumber = $row["max"];
    echo $largestNumber;

    // $query = "INSERT INTO Movie(id,title,year,rating,company)
    //           VALUES ($largestNumber+1, '{$title}', {$year}, '{$rate}', '{$company}');
    //           ";
    //
    // echo $query;

	mysql_close($db)
?>
