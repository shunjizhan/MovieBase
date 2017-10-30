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

    $query2 = "SELECT a.id, a.first, a.last, ma.role
               FROM Movie m, MovieActor ma, Actor a
               WHERE m.id='{$id}' AND m.id = ma.mid AND a.id = ma.aid";
    $result2 = mysql_query($query2, $db);

    print "<h4>Movie's Information is:</h4>";
    $table = new Table($result, 0);

    print "<h4>Actors in this Movies and Role:</h4>";
    $table2 = new Table($result2, 1);

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
