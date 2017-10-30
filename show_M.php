
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show Movie Information</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">

    <h3>Show Movie Information</h3>
    <form method="GET" action="#">
        <div class="form-group">
          <input type="text" class="form-control" name="search">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
    </form>

    <?php
      include "tables.inc";

      $db = mysql_connect("localhost", "cs143", "");
      if(!$db) {
        $errmsg = mysql_error($db);
        print "Connection failed: $errmsg <br>";
        exit(1);
      }

      mysql_select_db("CS143", $db);

      $search = $_GET["search"];
      $id = $_GET["id"];

      if ($id != NULL) {
        $query = "select * from Movie where id='{$id}'";
        $result = mysql_query($query, $db);
        //actors info query
        $query2 = "select concat(a.first, ' ', a.last) as 'name', ma.role from Actor a, MovieActor ma where ma.mid = '{$id}' and a.id = ma.aid ";
        $result2 = mysql_query($query2, $db);
        //review query
        $query3 = "select comment from Review where mid = '{$id}'";
        $result3 = mysql_query($query3, $db);
        $row = mysql_fetch_array($query3);

        print "<h4><b>Movie Information:</b></h4>";
        $table = new Table($result, 0);

        print "<h4><b>Actors in the Movie:</b></h4>";
        $table2 = new Table($result2, 1);

        print "<h4><b>User Review:</b></h4>";
        if($row["comment"] == ''){
          print "<a href='addReview.php?value_key=$id'>Be the first to add a review!</a>";
        }

      } else if($search != NULL) {
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
        new Table($result2, 2);

      }

      mysql_close($db);
    ?>

</div>
</body>
</html>
