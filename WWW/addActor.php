<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>CS143 Project 1c</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet"><link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/project1c.css" rel="stylesheet">

  <body>

    <!-- <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header navbar-defalt">
          <a class="navbar-brand" href="index.php">CS143 DataBase Query System (Demo)</a>
        </div>
      </div>
    </nav> -->

    <div class="container">
      <div class="row">
        <!-- <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <p>&nbsp;&nbsp;Add new content</p>
            <li><a href="homepage.php">Add Actor/Director</a></li>
            <li><a href="Add_movie.php">Add Movie Information</a></li>
            <li><a href="Add_M_A_R.php">Add Movie/Actor Relation</a></li>
            <li><a href="Add_M_D_R.php">Add Movie/Director Relation</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <p>&nbsp;&nbsp;Browsering Content :</p>
            <li><a href="Show_A.php">Show Actor Information</a></li>
            <li><a href="Show_M.php">Show Movie Information</a></li>
          </ul>
          <ul class="nav nav-sidebar">
            <p>&nbsp;&nbsp;Search Interface:</p>
            <li><a href="search.php">Search/Actor Movie</a></li>
          </ul>
        </div> -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h3>Add new Actor/Director</h3>
            <form method = "GET" action="<?php echo $_SERVER['PHP_SELF'];?>">
               <label class="radio-inline">
                    <input type="radio" checked="checked" name="identity" value="Actor"/>Actor
                </label>
                <label class="radio-inline">
                    <input type="radio" name="identity" value="Director"/>Director
                </label>
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" class="form-control" placeholder="Text input"  name="fname"/>
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" class="form-control" placeholder="Text input" name="lname"/>
                </div>
                <label class="radio-inline">
                    <input type="radio" name="sex" checked="checked" value="male">Male
                </label>
                <label class="radio-inline">
                    <input type="radio" name="sex" value="female">Female
                </label>
                <div class="form-group">
                  <label for="DOB">Date of Birth</label>
                  <input type="text" class="form-control" placeholder="Text input" name="dateb">ie: 1997-05-05<br>
                </div>
                <div class="form-group">
                  <label for="DOD">Date of Die</label>
                  <input type="text" class="form-control" placeholder="Text input" name="dated">(leave blank if alive now)<br>
                </div>
                <button type="submit" class="btn btn-default">Add!</button>
            </form>

        </div>
      </div>
    </div>
    <body>

      Welcome <?php echo $_GET["fname"]; ?><br>
      Your email address is: <?php echo $_GET["lname"]; ?>
      <?php
      $db = mysql_connect("localhost", "cs143", "");
    	if(!$db) {
    		$errmsg = mysql_error($db);
    		print "Connection failed: $errmsg <br>";
    		exit(1);
    	}

    	mysql_select_db("CS143", $db);

    	if ($_SERVER["REQUEST_METHOD"] == "GET") {
    		// $query = $_POST['query'];
        $fname = $_GET['fname'];
        $lname = $_GET['lname'];
        $gender = $_GET["gender"];
        $dateb = $_GET["dateb"];
    		$dated = $_GET["dated"];
        $query = "INSERT INTO Actor(id, last, first, sex, dob, dod)
                  VALUES (69999,$fname, $lname, $gender,$dateb,$dated)";
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
    	}

    	mysql_close($db)
      ?>
    </body>

</body>
</html>
