
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

    <h3>Show Actor Information</h3>
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
        $query = "select * from Actor where id='{$id}'";
        $result = mysql_query($query, $db);

          $query2 = "select m.title as 'Movie Title', ma.role as 'Role'
                     from MovieActor ma, Movie m
                     where ma.aid='{$id}' and ma.mid = m.id";
          $result2 =mysql_query($query2, $db);

          print "<h4>Actor's Information is:</h4>";
          $table = new Table($result, 0);

          print "<h4>Actor's Movies and Role:</h4>";
          $table2 = new Table($result2, 0);

      } else if($search != NULL) {
        print "<h4><b>Matching Actors Are:</b></h4>";

        $query = "  SELECT
        *
        FROM
        Actor
        WHERE
        last or first
        LIKE
        '". mysql_real_escape_string($search) ."%'
        ";

        $result = mysql_query($query, $db);

        $table = new Table($result, 1);
      }
      mysql_close($db);
    ?>

</div>
</body>
</html>
