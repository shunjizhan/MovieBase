
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

    <?php include("_search_A.php"); ?>

  </div>
</body>
</html>
