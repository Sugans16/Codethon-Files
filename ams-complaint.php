<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
  }
    else {
        header("Location: admin.php");
        exit;
      }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AMS-complaint</title>
  <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="style-home.css">
  <link rel="stylesheet" href="request-table.css">

</head>

<body>

  <div class="backgroundimg-home">

    <header>
      <nav>
        <img class="logo" src="images/logo/App Logo2.png" alt="company-logo">
      </nav>
    </header>
    <div>
      <h1 class="list-head"> Complaint List </h1>
      <table class="list-table">
        <thead>
          <tr>
            <th>Serial No</th>
            <th>Complaint Id</th>
            <th>Raised By</th>
            <th>Regarding</th>
            <th>Detailed View</th>
          </tr>
        </thead>
        <tbody id="requestBody">
        <?php
              include('db_connection.php');

              $sql = "SELECT * FROM ams_complaint";
              $result = $con->query($sql);
              $sno=1;
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $sno++ . "</td>";
                    echo "<td>" . "C0" . $row["id"] . "</td>";
                    echo "<td>" . ucfirst($row["Username"]) . "</td>";
                    echo "<td>" . $row["ComplaintRegarding"] . "</td>";
                    echo "<td>" . $row["Description"] . "</td>";
                    echo "</tr>";
                  }
              } else {
                  echo "0 results";
              }
              $con->close();
              ?>
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
$('.list-head').click(function (e) {
  e.preventDefault();

 
      let rowNumber = 1;
      let displayedData = {};

      function fetchDataAndUpdate() {
        $.ajax({
          type: 'POST',
          url: 'description.php',
          success: function (data) {
              // data.empty();
            $.each(data.rows, function (index, complaint) {
              displayedData[complaint.id] = true;
              if (complaint.status === 'pending' && displayedData[complaint.id]) {
                console.log('Adding row for pending complaint:', complaint);
                $('#requestBody').append('<tr class="data-row">' +
                  '<td>' + rowNumber++ + '</td>' +
                  '<td>' + complaint.Residencename + '</td>' +
                  '<td>' + complaint.ComplaintRegarding + '</td>' +
                  // '<td>' + complaint.Description + '</td>' +
                  '<td class="fix-last--td md-padding">' +
                  '<form class="approve-btn green-form">' +
                  // '<input type="hidden" name="form_id" value="form1">' +
                  // '<input type="hidden" name="username" value="' + complaint.username + '">' +
                  // '<input type="hidden" name="pass" value="' + complaint.u_password + '">' +
                  // '<input type="hidden" name="flat_no" value="' + complaint.flat_no + '">' +
                  // '<input type="hidden" name="block_no" value="' + complaint.block_no + '">' +
                  '<button class="child-green" type="submit" value="Accepted"><ion-icon name="checkmark-sharp"></ion-icon></button> </form>' +
                  // '<form class="approve-btn red-form">' +
                  // '<input type="hidden" name="form_id" value="form2">' +
                  // '<input type="hidden" name="username" value="' + complaint.username + '">' +
                  // '<input type="hidden" name="pass" value="' + complaint.u_password + '">' +
                  // '<input type="hidden" name="flat_no" value="' + complaint.flat_no + '">' +
                  // '<input type="hidden" name="block_no" value="' + complaint.block_no + '">' +
                  // '<button class="child-red" type="submit" value="Rejected"><ion-icon name="close"></ion-icon></button>' +
                  // '</form></td>' +
                  '</tr>'
                );

                displayedData[complaint.id] = true;
                console.log(displayedData[complaint.id]);
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
     

    //   Event listener for form submission
    //   $(document).on('submit', '.approve-btn', function (e) {
    //     e.preventDefault();
       
    //   //   $.ajax({
    //   //     type: 'POST',
    //   //     url: 'description.php',
    //   //     data: $(this).serialize(),
    //   //     success:function (data) {
    //   //       $('#requestBody').empty();
    //   //       rowNumber=1;
    //   //       fetchDataAndUpdate();
    //   //     },
    //   //     error:function(xhr, status, error) {
    //   //       console.log('Error in getting data from PHP:');
    //   //       console.log('Status:', status);
    //   //       console.log('Error:', error);
    //   //       console.log('Response Text:', xhr.responseText);
    //   //     }
    //   //   })
    //   // });
    //   fetchDataAndUpdate();
  })

    });

   
 </script>
</body>

</html>