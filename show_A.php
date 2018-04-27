
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
</head>

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

      if (isset($id)) {                   // display actor information
        $query = "select id, concat(last,' ',first) as 'Actor Name', sex, dob as 'Birthday', dod as 'Pass Away' from Actor where id='{$id}'";
        $result = mysql_query($query, $db);  

          $query2 = "SELECT m.title as 'Movie Title', ma.role as 'Role'
                     FROM MovieActor ma, Movie m
                     WHERE ma.aid='{$id}' and ma.mid = m.id";
          $result2 =mysql_query($query2, $db);

          $table = new Table($result, 0, "Actor's Information:");

          $table2 = new Table($result2, 0, "Actor's Movies and Role:");

      } else if(isset($search)) {           // show search result
        $keywords = explode(" ", mysql_real_escape_string($search));
        switch(count($keywords)) {
          case 0:
          case 1:
            $query = "SELECT * FROM Actor
                      WHERE (first LIKE '%$search%') OR (last LIKE '%$search%')";
            break;

          case 2:
            $keyword1 = $keywords[0];
            $keyword2 = $keywords[1];
            $query = "SELECT * FROM Actor
                      WHERE (first LIKE '%$keyword1%') AND (last LIKE '%$keyword2%') OR
                            (last LIKE '%$keyword1%') AND (first LIKE '%$keyword2%')";
            break;

          default:
            $query = "SELECT * FROM Actor WHERE FALSE";
        }

        $result = mysql_query($query, $db);

        $table = new Table($result, 1, "Matching Actors");
      }

      mysql_close($db);
    ?>

  </div>
</body>
</html>
