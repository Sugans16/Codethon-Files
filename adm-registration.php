<?php

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
}
else if (!isset($_COOKIE["admin"])){
  header("Location: admin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Admin Registration Page</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="style-registration.css">
</head>

<body>
  <div class="backgroundimg-registration">
    <header>
      <nav>
        <a href="admin.php"><img class="logo" src="images/logo/App Logo2.png" alt="company-logo"></a>
      </nav>
    </header>
    <div class="alert">
    <ion-icon class="login-icon ion-icon" name="checkmark"></ion-icon>
      <ion-icon class="error-icon ion-icon" name="alert-circle-outline"></ion-icon>
      <ion-icon class="close-btn ion-icon" name="close-outline"></ion-icon>
      <div class="msg-box">
        <h1 class="red-head">Oh snap!</h1>
        <p class="messagefromphp">Your email id doesn't exist</p>
      </div>
    </div>
    <main>

      <section class="img-box">
        <img class="regi-img" src="images/4 div/registration.jpg" alt="Ai-man-with-tab">
      </section>

      <section class="regi-box">
        <div class="margin-down">
          <h2 class="regi-head">Registration Form</h2>
          <!-- <p class="regi-subhead">For secturity and maintenance</p> -->
          <form class="flex-form" >
            <input class="registration-input" type="email" name="staff-email" placeholder="Email" required>
            <div class="pass-pack">
              <input class="registration-input i-password-regi" type="password" name="staff-password" placeholder="Password" required>
              <ion-icon class="regi-show" name="eye-outline"></ion-icon>
              <ion-icon class="regi-hide" name="eye-off-outline"></ion-icon>
            </div>
            <!-- <input class="registration-input" type="text" name="staff-role" placeholder="Role"> -->
            <select class="registration-input option" name="staff-role">
              <option class="option" value="" disabled selected>Role</option>
              <option class="option" value="Security">Security</option>
              <option class="option" value="Maintenance">Maintenance</option>
            </select>
            <button type="submit">Register</button>
          </form>
        </div>
      </section>
    </main>
  </div>

  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>
     $('.regi-show').click(function () {
      $('.i-password-regi').attr('type', 'text');
      $('.regi-hide').css('display', 'block');
      $('.regi-show').css('display', 'none');
    })

    $('.regi-hide').click(function () {
      $('.i-password-regi').attr('type', 'password');
      $('.regi-show').css('display', 'block');
      $('.regi-hide').css('display', 'none');
    })

    $('.close-btn-home').click(function () {
      $('.flat-alert').slideToggle();
    })
    //////// For nav profile /////////////
    $('.nav-link').click(function () {
      $('.nav-hover').slideToggle();
    })

    $('.close-btn').click(function () {
      $('.alert').css('display', 'none');
    })
    function notification(data1, data2, data3,data4,data5) {
      $('.alert').css('display', 'inline-block');
      $('.alert').css('background-color', data1);
      $('.alert').css('color', data2);
      $('.ion-icon').css('color', data2);
      $('.messagefromphp').text(data4);
      $('.red-head').text(data5);

      let symbol = data3;
      console.log(data3);
switch (symbol) { 
	case 'login-icon': 
		$('.login-icon').css('display', 'block');
    $('.error-icon').css('display', 'none');  
		break;
	case 'error-icon': 
		$('.error-icon').css('display', 'block');
    $('.login-icon').css('display', 'none');
		break;
	default:
  $('.login-icon').css('display', 'block');
}
    }

    $(document).ready(function () {
      $('.flex-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: "main&sec-regi.php",
          data: $('.flex-form').serialize(),
          success: function (response) {
            
            console.log(response);

            if(response) {
            let backgroundClr = '#DEF0D8';
            let textClr = '#3A7B50';
            let icon = 'login-icon';
            let errortitle = "Great";
            let errormsg = "Account Created Successfully" ;

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
          } else if (!response) {
            let backgroundClr = '#FFF5E7';
            let textClr = '#B26000';
            let icon = 'error-icon';
            let errortitle = "Oh snap!";
            let errormsg = "Sorry, Account registration failed, Try again";

            notification(backgroundClr,textClr,icon,errormsg,errortitle);
          }
            
          },
          error: function (xhr, status, error, response) {
            console.log(response);
            console.error('AJAX Error:',error, status);
          }
        })
      })
    })
  </script>
</body>

</html>