<?php
require_once "../includes/main.php";
require_once "../includes/mail.php";

$alert1 = "Wrong Email";
$alert2 = "Your password has been sent to your email";
$alert3 = "Error Sending Email, Try again";
$alert4 = "Recover Account";

if (isset($_POST))
{

    if ((!empty($_POST['maxam_user'])))
    {
        $username = strtolower($_POST['maxam_user']);
        $username = mysqli_real_escape_string($conn, $username);
        $getuser = mysqli_query($conn, "SELECT * FROM cm_superuser WHERE email = '$username'");
        if (mysqli_num_rows($getuser) == 0)
        {
            header("location:forgot.php?msg=$alert1");
            exit;
        }
        if (mysqli_num_rows($getuser) == 1)
        {
            while ($ix = mysqli_fetch_assoc($getuser))
            {
                $password = $ix['password'];
                $name = $ix['name'];
                $email = $ix['email'];
                $admin_number = $ix['phone'];
                $password = Cryptography::decrypt($password);
                $password = trim($password);
            }

    $message = "Community Manager
    Hello $name,
    Here is your login credentials.
    
    Username: $username
    Password: $password

    or copy and paste .".$mi6."/15crew/

    update your password under the manage profile tab.";

    $response = sendViaPost('BulkSMSNG', $admin_number, $message);//BulkSMSNG - CManager
    $response_code = trim($response['code']);
    $response_body = $response['body'];

            if ($response_code == 200)
            {
                header("location:forgot.php?msg=$alert2");
                exit;
            }
            else
            {
                header("location:forgot.php?msg=$alert3");
                exit;
            }

        }
    }
}
?>