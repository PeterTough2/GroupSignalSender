<?php
require_once "../includes/main.php";

$alert1 = "Wrong Credentials";

$admintbl = "cm_superuser";

if (isset($_POST))
{

    if ((!empty($_POST['stash_user'])) || (!empty($_POST['stash_pass'])) || (isset($_POST['stash_init'])))
    {
        $username = $_POST['stash_user'];
        $password = $_POST['stash_pass'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $sql = "SELECT * FROM $admintbl WHERE email = '$username' LIMIT 1";
        $sqlexe = mysqli_query($conn, $sql);

        if (mysqli_num_rows($sqlexe) == 1)
        {
            while ($mox = mysqli_fetch_assoc($sqlexe))
            {
                $ID = $mox['id'];
                $name = $mox['name'];
                $db_password = $mox['password'];

                $sentPass = $password;
                $storedPass = Cryptography::decrypt($db_password);
                if ($sentPass == $storedPass)
                {
                    $_SESSION['cm_superuser'] = $username;
                    $_SESSION['cm_superpass'] = $db_password;
                    mysqli_query($conn, "UPDATE $admintbl SET lastlogin = '$SERVERTIME' WHERE id = '$ID' LIMIT 1");
                    header("location:portal.php");
                    exit;
                }
                else
                {
                    header("location:index.php?msg=$alert1");
                    exit;
                }
            }
            
        }
        if (mysqli_num_rows($sqlexe) == 0)
        {
            header("location:index.php?msg=$alert1");
            exit;
        }

    }
}
?>