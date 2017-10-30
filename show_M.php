
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

      function fetch_first_row($result) {
        $row = mysql_fetch_assoc($result);
        mysql_data_seek($result, 0);
        return $row;
      }

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
        $query = "select * from Movie where id='{$id}'";
        $result = mysql_query($query, $db);
        $title = fetch_first_row($result)['title'];
        $table = new Table($result, 0, "Movie's Information:");

        $query2 = "SELECT a.id, concat(a.first, ' ', a.last) as 'Actor Name', ma.role
                   FROM MovieActor ma, Actor a
                   WHERE ma.mid = '{$id}' AND a.id = ma.aid";
        $result2 = mysql_query($query2, $db);
        $table2 = new Table($result2, 1, "Actors in this Movies and Role:");

        $query3 = "SELECT name, time, rating, comment from Review where mid = '{$id}'";
        $result3 = mysql_query($query3, $db);
        $table3 = new Table($result3, 0, "User Review:");

        if(mysql_num_rows($result3)) {
          print "<a href='addReview.php?value_key=$id&title=$title'>Add another review</a>";
        } else {
          print "No one has reviewed this movie yet. <br>";
          print "<a href='addReview.php?value_key=$id&title=$title'>Be the first to add a review!</a>";
        }

      } else if(isset($search)) {           // show search result
        $keywords = explode(" ", mysql_real_escape_string($search));
        $query = "SELECT * FROM Movie WHERE title LIKE '%$keywords[0]%'";
        for($i = 1; $i < count($keywords); $i++) {
          $query .= "AND title LIKE '%$keywords[$i]%'";
        }

        $result = mysql_query($query, $db);

        $table = new Table($result, 2, "Matching Movies:");
      }

      mysql_close($db);
    ?>


</div>
</body>
</html>
