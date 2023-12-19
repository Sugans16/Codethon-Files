<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["user"])) {
  
  $user_cookie = $_COOKIE['user'] ?? "";
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "ams";

  $con = new mysqli($hostname, $username, $password, $database);

  if ($con->connect_error) {
      die("Connection failed: " . $con->connect_error);
  }

  $query = "SELECT * FROM users WHERE username = '$user_cookie' ";

  $result = $con->query($query);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    $block_no = $row['block_no'];
    $flat_no = $row['flat_no'];
    $name = $row['tenant_name'];

  }
  
}
else if (!isset($_COOKIE["user"])){
  header("Location: user.php");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";

    $con = new mysqli($hostname, $username, $password, $database);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    
    $pass_name = $_POST['residence_name'];
    $block_no = $_POST['block_no'];
    $flat_no = $_POST['flat_no'];
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $visitor_name = $_POST['visitor_name'];
    $visitor_contact = $_POST['visitor_contact'];
    $v_status = "Pending";
    $query = "INSERT INTO ams_visitorpass (creator, block_no, flat_no, from_date, to_date, Visitor_name, Visitor_contact, v_status) VALUES ('$pass_name', '$block_no', '$flat_no', '$from_date', '$to_date', '$visitor_name', '$visitor_contact', '$v_status')";
    $con->query($query);

    $query = "SELECT * FROM ams_visitorpass WHERE flat_no = '$flat_no' ";

    $result = $con->query($query);

  if ($result->num_rows >= 1) {
    $row = $result->fetch_assoc();
    echo $row['V_ID'];
  }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Visitor pass page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">
    <header>
      <nav class="home-nav">
        <a href="user.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>

    <section class="choice-container">
        <form action='visitor_pass.php' method='post' onsubmit="refreshPage()">
                <div class="child-item">
                <input type="hidden" value=" <?php echo $name ?>" name="residence_name" required><br>
                </div>
                <div class="child-item">
                <input type="hidden" value=" <?php echo $block_no ?>" name="block_no" required><br>
                </div>
                <div class="child-item">
                <input type="hidden" value=" <?php echo $flat_no ?>" name="flat_no" required><br>
                </div>
                <div class="child-item">
                <label for="From_Date" class="img-text">FROM DATE:</label>
                <input type="date" name="from_date" required><br>
                </div>
                <div class="child-item">
                <label for="To_Date" class="img-text">TO DATE:</label>
                <input type="date" name="to_date" required><br>
                </div>
                <div class="child-item">
                <label for="visitor_name" class="img-text">Visitor Name:</label>
                <input type="text" name="visitor_name" required><br>
                </div>
                <div class="child-item">
                <label for="visitor_contact" class="img-text">Visitor Contact:</label>
                <input type="text" name="visitor_contact" required><br>
                </div>
                <div class="child-item">
                <div class="child-item">
                <input type="submit" value="Generate Visitor Pass">
                </div>
        </form>
    </section>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    //////// For colsing alert /////////////
    $('.close-btn-home').click(function () {
      $('.flat-alert').slideToggle();
    })
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })
  </script>
  <script>
    $(document).ready(function () {
        // Handle form submission
        $('form').submit(function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Append the existing GET parameters to the form data
            var currentUrl = window.location.href;

            // If there are existing GET parameters, append "&" to the URL
            var separator = currentUrl.indexOf('?') === -1 ? '?' : '&';

            // Append the existing GET parameters to the form data
            var urlWithParameters = currentUrl + separator + formData;

            // Redirect to the URL with GET parameters
            window.location.href = urlWithParameters;
        });
    });
</script>

</body>

</html>