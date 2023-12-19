<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_COOKIE['user'] ?? "";
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "ams";

    $con = new mysqli($hostname, $username, $password, $database);

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "INSERT INTO ams_complaint(Username, ComplaintRegarding, Description) VALUES (?, ?, ?)";
$stmt = $con->prepare($query);

$stmt->bind_param("sss", $rname, $complaintreg, $complaintdes);

$rname = $user;
$complaintreg = $_POST['complaint_reg'];
$complaintdes = $_POST['complaint_des'];

$stmt->execute();

    if ($stmt->affected_rows > 0) {
        
        echo "Complaint Received, Admin will take action ";
    } else {
        echo "Complaint not received properly";
    }

    $stmt->close();
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Visitor pass page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Overpass:wght@400;600;800&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">
    <header>
      <nav>
        <a href="user.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>

    <section class="container-form-complaint">
      <h1 class="form-label">Complaint Form</h1>
      <form action='complaint.php' method='post'>
        <div class="mail-form">
          <div class="child-item">
              <select class="com-on" name="complaint_reg" required>
                <option  value="" disabled selected>Complaint on</option>
                <option  value="Users">Resident</option>
                <option  value="Security">Security</option>
                <option  value="Maintenance">Maintenance</option>
          </select><br>
        </div>
        </div>
        <div>
        <div class="child-item">
          <label for="complaint_des" class="img-text">Description:</label>
          <textarea name="complaint_des" rows="9" cols="65" required></textarea>
        </div>
        </div>
        <div class="last-item">
          <input type="submit" value="Register">
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
</body>

</html>