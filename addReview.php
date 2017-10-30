
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

    <form method="GET" action="#">
        <div class="form-group">
          <!-- <input type="text" class="form-control" name="search"> -->
        </div>
        <!-- <button type="submit" class="btn btn-default">Search</button> -->
    </form>
    <?php
      $id = $_GET['value_key'];
      echo $id;
      include "tables.inc";

      $db = mysql_connect("localhost", "cs143", "");
      if(!$db) {
        $errmsg = mysql_error($db);
        print "Connection failed: $errmsg <br>";
        exit(1);
      }

      mysql_select_db("CS143", $db);
      $query = "select title from Movie where id = {$id}";
      $row = mysql_fetch_array($query);
      $title = $row["title"];
      echo $title;

      print "<h3><b>Add New Comments here:</b></h3>";
      print "<h5><b>Movie Title: {$title}</b></h5>";
      mysql_close($db);

     ?>
  </div>
  </body>
  </html>
