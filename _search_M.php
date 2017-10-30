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
    $query = "select * from Movie where id='{$id}'";
    $result = mysql_query($query, $db);

    $query2 = "SELECT a.id, concat(a.first, ' ', a.last) as 'Actor Name', ma.role
               FROM MovieActor ma, Actor a
               WHERE ma.mid = '{$id}' AND a.id = ma.aid";
    $result2 = mysql_query($query2, $db);

    $query3 = "SELECT comment from Review where mid = '{$id}'";
    $result3 = mysql_query($query3, $db);
    $row = mysql_fetch_array($query3);

    print "<h4>Movie's Information is:</h4>";
    $table = new Table($result, 0);

    print "<h4>Actors in this Movies and Role:</h4>";
    $table2 = new Table($result2, 1);

    print "<h4><b>User Review:</b></h4>";
    if($row["comment"] == ''){
      $query = "select * from Movie where id='{$id}'";
      $result = mysql_query($query, $db);
      $title = mysql_fetch_row($result)[1];
      print "<a href='addReview.php?value_key=$id&title=$title'>Be the first to add a review!</a>";
    } else {
      // show comments
    }

  } else if(isset($search)) {           // show search result
    print "<h4><b>Matching Movies Are:</b></h4>";

    $keywords = explode(" ", mysql_real_escape_string($search));
    $query = "SELECT * FROM Movie WHERE title LIKE '%$keywords[0]%'";
    for($i = 1; $i < count($keywords); $i++) {
      $query .= "AND title LIKE '%$keywords[$i]%'";
    }

    $result = mysql_query($query, $db);

    $table = new Table($result, 2);
  }

  mysql_close($db);
?>
