<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add new Relationship between Movie/Director</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Add New Movie Director Relation</title>
    <link href="css/all.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontAwesome/css/font-awesome.css" rel="stylesheet">

  <body>
    <?php include("navigation.php"); ?>

    <div class="main_container">
    <h3>Add new Relationship between Movie/Director</h3>
    
    <form method="GET" action="#">
        <div class="form-group">
          <label for="title">Movie Title:</label>
              <?php
              	$db = mysql_connect("localhost", "cs143", "");
              	if(!$db) {
              		$errmsg = mysql_error($db);
              		print "Connection failed: $errmsg <br>";
              		exit(1);
              	}

              	mysql_select_db("CS143", $db);

                $sql=mysql_query("SELECT title, year FROM Movie");
                if(mysql_num_rows($sql)){
                $select= '<select class="form-control" name="title">';
                while($rs=mysql_fetch_array($sql)){
                      $select.='<option value="'.$rs['title'].'">'.$rs['title'].'   ['.$rs['year'].']'.'</option>';
                  }
                }
                $select.='</select>';
                echo $select;
                ?>
        </div>
        <div class="form-group">
          <label for="director">Director</label>
              <?php
                $db = mysql_connect("localhost", "cs143", "");
                if(!$db) {
                  $errmsg = mysql_error($db);
                  print "Connection failed: $errmsg <br>";
                  exit(1);
                }

                mysql_select_db("CS143", $db);

                $sql=mysql_query("SELECT first, last, dob FROM Director");
                if(mysql_num_rows($sql)){
                $select= '<select class="form-control" name="director">';
                while($rs=mysql_fetch_array($sql)){
                      $select.='<option value="'.$rs['first'].' '.$rs['last'].'">'.$rs['first'].' '.$rs['last'].'  ['.$rs['dob'].']'.'</option>';
                  }
                }
                $select.='</select>';
                echo $select;
                ?>
        </div>
        <button type="submit" name="add" class="btn btn-default">Add!</button>
        <?php
            if (isset($_GET['add']))
            {
            echo "add success";
            }
            else
            {
            echo "";
            }
        ?>
    </form>
    <?php
    	$db = mysql_connect("localhost", "cs143", "");
    	if(!$db) {
    		$errmsg = mysql_error($db);
    		print "Connection failed: $errmsg <br>";
    		exit(1);
    	}

    	mysql_select_db("CS143", $db);

    		$title = $_GET["title"];
    		$director = $_GET["director"];

    		echo "$title $director";
        //get the Movie id number
        $rowSQL = mysql_query("SELECT id as mid FROM Movie WHERE title = '$title';");
        $row = mysql_fetch_array($rowSQL);
        $pieces = explode(" ", $director);
        // echo $pieces[0], $pieces[1];
        $didSQL = mysql_query("SELECT id as did FROM Director WHERE first = '$pieces[0]' and last = '$pieces[1]' ;");
        $didRow = mysql_fetch_array($didSQL);
        // echo $row[1];
        $mid = $row["mid"];
        $did = $didRow["did"];
        echo $mid, "mid   ";
        echo $did, "did   ";

        $query = "INSERT INTO MovieDirector(mid,did)
                  VALUES ($mid, $did);
                  ";
        mysql_query($query, $db);
        echo $query;
        // print "add success: $mid, $did ";


    	mysql_close($db)
    ?>
  </div>


</body>
</html>
