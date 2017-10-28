
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show Actor Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">

    <h3>Search Actor and Movie Info</h3>
    <form method="GET" action="#">
        <div class="form-group">
          <input type="text" class="form-control" name="search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
    </form>

    <h4><b>Matching Actors Are:</b></h4>
    <?php
    	$db = mysql_connect("localhost", "cs143", "");
    	if(!$db) {
    		$errmsg = mysql_error($db);
    		print "Connection failed: $errmsg <br>";
    		exit(1);
    	}

    	mysql_select_db("CS143", $db);

    		$search = $_GET["search"];
        if($search != NULL) {

        $query = "  SELECT
                        *
                    FROM
                        Actor
                    WHERE
                        last or first
                    LIKE
                        '". mysql_real_escape_string($search) ."%'
        ";
        echo $query;

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
            print "<th><a href='#'>$row[$i]</a></th>";
          }
          print "</tr>";
        }
        print "</table>";

    print "<h4><b>Matching Movies Are:</b></h4>";
    $query2 = "  SELECT
                    *
                FROM
                    Movie
                WHERE
                    title
                LIKE
                    '". mysql_real_escape_string($search) ."%'
    ";

    $result2 = mysql_query($query2, $db);
    print "<table>";

    print "<tr>";
    for($i = 0; $i < mysql_num_fields($result2); $i++) {
        $field_info = mysql_fetch_field($result2, $i);
        echo "<th>{$field_info->name}</th>";
    }
    print "</tr>";

    while($row = mysql_fetch_row($result2)) {
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
</div>
</body>
</html>
