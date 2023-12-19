<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Admin Home Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
</head>

<body>
  <div class="backgroundimg-home">

    <header>
      <nav class="home-nav">
        <a href="admin.php"> <img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
        <h1 class="welcome-msg"><span class="user-name">Hello <?php echo $user_cookie ?></span></h1>
        <nav class="nav-link">
          <img class="profile-icon" src="images/logo/User-profile-logo.png" alt="3d-user-icon">
          <div class="nav-hover adjus">
            <a class="list-link" href="#">
              <ion-icon class="user-profile-nav" name="person"></ion-icon>
              <span>Profile</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
            <a class="list-link" href="logout.php?action=admin_logout">
              <ion-icon name="log-out-outline"></ion-icon>
              <span>Logout</span>
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
          </div>
        </nav>
      </nav>
    </header>
    <section class="choice-container">
      <div class="child-item">
        <a class="img-link" href="adm-request-table.php">
          <img class="img-child" src="images/4 div/request.jpg" alt="Ai-hand">
          <span class="img-text">Request</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link" href="adm-registration.php">
          <img class="img-child" src="images/4 div/registration2.jpg" alt="Waring-sign-in-yellow-board">
          <span class="img-text">Registration</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link" href="ams_records.php">
          <img class="img-child" src="images/4 div/Workers.jpg" alt="Ai-men-with-tablet">
          <span class="img-text">AMS Record</span>
        </a>
      </div>
      <div class="child-item">
        <a class="img-link" href="ams-complaint.php">
          <img class="img-child" src="images/4 div/help.jpg" alt="Waring-sign-in-yellow-board">
          <span class="img-text">Complaint/Issue</span>
        </a>
      </div>

    </section> 
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
    $('.close-btn-home').click(function () {
      $('.flat-alert').slideToggle();
    })
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })
  </script>
    <script>
function isBackNavigation() {
    return sessionStorage.getItem('reloadPage') !== null;
}

// Set the key when the page is about to unload
window.addEventListener('beforeunload', function () {
    sessionStorage.setItem('reloadPage', 'true');
});

// Check for back navigation on page load
window.addEventListener('pageshow', function (event) {
    if (isBackNavigation() && event.persisted) {
        // Clear the key to avoid unnecessary reloads
        sessionStorage.removeItem('reloadPage');

        // Perform actions for back navigation (e.g., reload the page)
        location.reload();
    }
});
    </script>
</body>

</html>
<?php
  }
  else {
    header("Location: admin.php");
    exit;
  }
?>