<?php
  $db = mysql_connect("localhost", "cs143", "");
  if(!$db) {
    $errmsg = mysql_error($db);
    print "Connection failed: $errmsg <br>";
    exit(1);
  }
  mysql_select_db("CS143", $db);

  $sql = mysql_query("SELECT title, year FROM Movie");
  if(mysql_num_rows($sql)) {
    $select = '<select class="form-control" name="title">';
    while($rs = mysql_fetch_array($sql)) {
          $select.='<option value="'.$rs['title'].'">'.$rs['title'].'   ['.$rs['year'].']'.'</option>';
      }
  }
  $select.='</select>';
  echo $select;

?>
