<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flat = $_POST['flat-no'];
    $block = $_POST['block-no'];
    $user = $_POST['susername'];
    $pass = $_POST['suserpassword'];
    $status = "Pending";

    $hostname = "localhost";
    $usernamee = "root";
    $password = "";
    $database = "ams";
    

    $con = new mysqli($hostname, $usernamee, $password, $database);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "SELECT * FROM user_signup WHERE flat_no = '$flat' AND block_no = '$block' ";

    $result = $con->query($query);

    if ($result) {
        if ($result->num_rows >= 1) {
            $row = $result->fetch_assoc();

            if ($row['status'] == "Accepted") {
                $login = array(
                    'backgroundColor' => '#DEF0D8',
                    'textColor' => '#3A7B50',
                    'icon' => 'login-icon',
                    'errortitle' => "Well Done!",
                    'errorMsg' => "Your Account is Created, You can Login Now",
                    
                  );
                  header('Content-Type: application/json');
                echo json_encode($login);
            } elseif ($row['status'] == "Rejected") {
                $updateQuery = "UPDATE user_signup 
                                SET username = '$user',
                                `u_password` = '$pass',
                                `status` = 'Pending'
                                WHERE flat_no = '$flat' ";
                
                $con->query($updateQuery);
                $rejected = array(
                    'backgroundColor' => '#F2DEDF',
                    'textColor' => '#AA4247',
                    'icon' => 'reject-icon',
                    'errortitle' => "Oh snap!",
                    'errorMsg' => "Previous rejection updated.Please await admin validation.."
                  );
                  header('Content-Type: application/json');
                echo json_encode($rejected);
                
            }
            else {
                $pending = array(
                    'backgroundColor' => '#E2E3E5',
                    'textColor' => '#3C4246',
                    'icon' => 'wait-icon',
                    'errortitle' => "Sorry",
                    'errorMsg' => "Your Profile Still in Pending."
                  );
                  header('Content-Type: application/json');
                echo json_encode($pending);
                // echo "Sorry, Profile Still in Pending";
            }
        } else {
            $insertQuery = "INSERT INTO user_signup (block_no, flat_no, username, u_password, `status`) 
                            VALUES ('$block', '$flat', '$user', '$pass', '$status')";
            
            if ($con->query($insertQuery)) {
                $created = array(
                    'backgroundColor' => '#D9EDF6',
                    'textColor' => '#336E86',
                    'icon' => 'wait-icon',
                    'errortitle' => "Heads up!",
                    'errorMsg' => "Wait Until Admin Validates Your Profile."
                  );
                  header('Content-Type: application/json');
                echo json_encode($created);
            } else {
                echo "Error: " . $con->error;
            }
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Close the connection
    $con->close();
}
?>
