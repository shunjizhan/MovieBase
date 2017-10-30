<?php
session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add Reviews</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/all.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
     <?php
       include "tables.inc";
       $name = $_GET["name"];
       $rate = $_GET["rate"];
       $comment = $_GET["comment"];
       $_SESSION["id"] = $_GET['value_key'];
       echo $_SESSION["id"];
       if (isset($name)) {
        //  echo $id;

         $db = mysql_connect("localhost", "cs143", "");
         if(!$db) {
           $errmsg = mysql_error($db);
           print "Connection failed: $errmsg <br>";
           exit(1);
         }

         mysql_select_db("CS143", $db);
         $rowSQL = mysql_query("SELECT title as 'Title' from Movie where id = {$id}");
         $result = mysql_query($query, $db);
         // $table = new Table($result, 0);
         $row = mysql_fetch_array($rowSQL);
         $title = $row['Title'];
         // print $title;

         echo $name, $rate, $comment;
         $time = date('Y-m-d');
         echo $time;
         $idd = $_SESSION["id"];
         $query = "INSERT INTO Review
                   VALUES('$name', $time, $idd, $rate, '$comment');";
         $result = mysql_query($query, $db);
         echo $query;

         print "<h3><b>Add New Comments here:</b></h3>";
         print "<h5><b>Movie Title: {$title}</b></h5>";
        //  print "add success";
         mysql_close($db);
      }
      ?>
    <form method="GET" action="#">
      <div class="form-group">
        <label for="Name">Your Name</label>
        <input type='text' class='form-control' name='name'>
      </div>
      <div class="form-group">
          <label for="Rating">Your Rating</label>
          <select class="form-control" name="rate">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
          </select>
      </div>
      <div class="form-froup">
        <label for="TextArea">Your Comments</label>
        <textarea class="form-control" name="comment" rows="5"  placeholder="no more than 500 characters" ></textarea><br>
     </div>
     <button type="submit" name = "bt" class="btn btn-default">Add!</button>
    </form>



  </div>
  </body>
  </html>
