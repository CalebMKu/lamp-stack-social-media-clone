<?php
  $servername = "localhost";
  $username = "your_username";
  $password = "your_password";
  $dbname = "TwitterClone";
  
  // connecting to mysql backend (created database in mysql shell)
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  if (!$conn) {
    die("Connection to database failed");
  }
 
  function query($query) {
    // declaring "global $conn" so I can access it without errors
    global $conn;
    mysqli_query($conn, $query);
  }
  
  if ($_REQUEST["tweet"]) {
    $tweet = $_REQUEST["tweet"];
    // date format
    $date = date("Y-m-d H:i:s");
    
    // inserting the $tweet and $date into the "tweet" table I created in the mysql shell
    query("insert into tweet (body, date) values ('$tweet', '$date')");
    // selecting all the tweets from the tweet table
    $result = query("select * from tweet order by date desc");
    
    // printing the tweet into the frontend
    echo "<div class='container d-flex justify-content-center mt-5'><table border=1>
      <tr>
        <td>$tweet</td>
        <td>$date</td>
      </tr> 
    </table></div>";
  }
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

<div class="container mt-5">
  <form action=index.php class="d-flex items-center">
    <input name=tweet class="form-control" placeholder="Start typing..." />
    <!-- When the user presses this button the tweet will be added to the database table and printed on the frontend -->
    <button type=submit class="btn btn-primary">POST</button>
  </form>
</div>
