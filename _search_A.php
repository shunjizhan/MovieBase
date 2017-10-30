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
    $query = "select * from Actor where id='{$id}'";
    $result = mysql_query($query, $db);

      $query2 = "SELECT m.title as 'Movie Title', ma.role as 'Role'
                 FROM MovieActor ma, Movie m
                 WHERE ma.aid='{$id}' and ma.mid = m.id";
      $result2 =mysql_query($query2, $db);

      print "<h4>Actor's Information is:</h4>";
      $table = new Table($result, 0);

      print "<h4>Actor's Movies and Role:</h4>";
      $table2 = new Table($result2, 0);

  } else if(isset($search)) {           // show search result
    print "<h4><b>Matching Actors Are:</b></h4>";

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

    $table = new Table($result, 1);
  }

  mysql_close($db);
?>
