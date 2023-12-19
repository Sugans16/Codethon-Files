<?php
  
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_COOKIE["admin"])) { 
    $user_cookie = $_COOKIE['admin'] ?? "";
}else if (!isset($_COOKIE["admin"])){
    header("Location: admin.php");
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMS-Records</title>
    <link rel="shortcut icon" href="images/Favicon/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Overpass:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="request-table.css">
</head>

<body>
    <div class="background-img ">
        <header>
            <nav>
                <img class="logo" src="images/logo/App Logo2.png" alt="company-logo">
            </nav>
        </header>

        <div class="box">
                <form  class="three-buttons" method="post" action="ams_records.php">
                    <button type="submit" name="residence" class=" img-text">Residence Record</button>
                    <button type="submit" name="security" class=" img-text">Security Record</button>
                    <button type="submit" name="maintenance" class=" img-text">Maintenance Record</button>
                </form>
            <div>
                <div>
                    <table class="list-table">
                        
                        <?php include('db_connection.php');

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
                                if (isset($_POST['residence'])) {
                                    echo  "<thead>";
                                    echo      "<tr>";
                                    echo "<th>Serial No</th>";
                                    echo    "<th>Block no</th>";
                                    echo    "<th>Flat no</th>";
                                    echo "<th>Username</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Phone No</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $sql = "SELECT * FROM users"; 
                                    $result = $con->query($sql);
                                    $sno=1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sno++ . "</td>";
                                        echo "<td>" . ($row["block_no"] ?? "-") ."</td>"; 
                                        echo "<td>" . ($row["flat_no"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["username"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["tenant_email"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["tenant_phone_no"] ?? "-") . "</td>";
                                        echo "</tr>";
                                    }
                                } elseif (isset($_POST['security'])) {
                                    echo  "<thead>";
                                    echo      "<tr>";
                                    echo "<th>Serial No</th>";
                                    echo "<th>Security Id</th>";
                                    echo "<th>Firstname</th>";
                                    echo "<th>Lastname</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Phone No</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $sql = "SELECT * FROM ams_security"; 
                                    $result = $con->query($sql);
                                    $sno=1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sno++ . "</td>";
                                        echo "<td>" . ($row["security_id"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["f_name"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["l_name"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["email"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["mobile"] ?? "-"). "</td>";
                                        echo "</tr>";
                                }}
                                elseif (isset($_POST['maintenance'])) {
                                    echo  "<thead>";
                                    echo      "<tr>";
                                    echo "<th>Serial No</th>";
                                    echo "<th>Maintenance Id</th>";
                                    echo "<th>Firstname</th>";
                                    echo "<th>Lastname</th>";
                                    echo "<th>Email</th>";
                                    echo "<th>Phone No</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    $sql = "SELECT * FROM ams_maintenance"; 
                                    $result = $con->query($sql);
                                    $sno=1;
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $sno++ . "</td>";
                                        echo "<td>" . ($row["maintenance_id"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["f_name"] ?? "-"). "</td>";
                                        echo "<td>" . ($row["l_name"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["email"] ?? "-") . "</td>";
                                        echo "<td>" . ($row["mobile"] ?? "-"). "</td>";
                                        echo "</tr>";
                                }}
                            $con->close();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>