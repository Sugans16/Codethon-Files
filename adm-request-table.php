<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-Admin Request Table</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="request-table.css">

</head>

<body>

  <div class="background-img-table">

    <header>
      <nav>
        <img class="logo" src="images/logo/App Logo2 White.png" alt="company-logo">
      </nav>
    </header>
    <div>
      <h2 class="list-head">Approval List</h2>
      <table class="list-table">
        <thead>
          <tr>
            <th>Serial No</th>
            <th>Username</th>
            <th>Block No</th>
            <th>Flat No</th>
            <th>Request</th>
          </tr>
        </thead>
        <tbody id="requestBody">
   
        </tbody>
      </table>
    </div>
  </div>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script>



/////////This ajax fetch data from table when 1st time page loads///////////////
$(document).ready(function () {
      let rowNumber = 1;
      let displayedData = {};

      function fetchDataAndUpdate() {
        $.ajax({
          type: 'POST',
          url: 'request.php',
          dataType: 'json',
          success: function (data) {
              // data.empty();
            $.each(data.rows, function (index, booking) {
              displayedData[booking.flat_no] = true;
              console.log(data);
              if (booking.status == 'Pending' && displayedData[booking.flat_no]) {
                console.log('Adding row for pending booking:', booking);
                $('#requestBody').append('<tr class="data-row">' +
                  '<td>' + rowNumber++ + '</td>' +
                  '<td>' + booking.username + '</td>' +
                  '<td>' + booking.block_no + '</td>' +
                  '<td>' + booking.flat_no + '</td>' +
                  '<td class="fix-last--td md-padding">' +
                  '<form class="approve-btn green-form">' +
                  '<input type="hidden" name="form_id" value="form1">' +
                  '<input type="hidden" name="username" value="' + booking.username + '">' +
                  '<input type="hidden" name="pass" value="' + booking.u_password + '">' +
                  '<input type="hidden" name="flat_no" value="' + booking.flat_no + '">' +
                  '<input type="hidden" name="block_no" value="' + booking.block_no + '">' +
                  '<button class="child-green" type="submit" value="Accepted"><ion-icon name="checkmark-sharp"></ion-icon></button> </form>' +
                  '<form class="approve-btn red-form">' +
                  '<input type="hidden" name="form_id" value="form2">' +
                  '<input type="hidden" name="username" value="' + booking.username + '">' +
                  '<input type="hidden" name="pass" value="' + booking.u_password + '">' +
                  '<input type="hidden" name="flat_no" value="' + booking.flat_no + '">' +
                  '<input type="hidden" name="block_no" value="' + booking.block_no + '">' +
                  '<button class="child-red" type="submit" value="Rejected"><ion-icon name="close"></ion-icon></button>' +
                  '</form></td>' +
                  '</tr>'
                );
               

                displayedData[booking.flat_no] = true;
                console.log(displayedData[booking.flat_no]);
              }
            });
          },
          error: function (xhr, status, error) {
            console.log('Error in getting data from PHP:');
            console.log('Status:', status);
            console.log('Error:', error);
            console.log('Response Text:', xhr.responseText);
          }
        });
      }
     

      // Event listener for form submission
      $(document).on('submit', '.approve-btn', function (e) {
        e.preventDefault();
       
        $.ajax({
          type: 'POST',
          url: 'approval and rejection.php',
          data: $(this).serialize(),
          success:function (data) {
            $('#requestBody').empty();
            rowNumber=1;
            fetchDataAndUpdate();
          },
          error:function(xhr, status, error) {
            console.log('Error in getting data from PHP:');
            console.log('Status:', status);
            console.log('Error:', error);
            console.log('Response Text:', xhr.responseText);
          }
        })
      });
      fetchDataAndUpdate();
    });

   
 </script>
</body>

</html>

<?php
  }
  else if (!isset($_COOKIE["admin"])){
    header("Location: admin.php");
exit();
}
?>