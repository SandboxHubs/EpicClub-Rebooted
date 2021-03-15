<?php 

class RegisteringFunctions {
    static function checkUsername($username){
        $usernameL = strlen($username);
        if ($usernameL < 4 || $usernameL > 20){
            echo "<h1> Invalid Username!</h1>";
        }

    }

    static function RegisterUser($username,$password,$email,$gender){
            setcookie('EPICNAME', $username, time() + 259200, '/');
    setcookie('EPICPASS', $password, time() + 259200, '/');
    }
    static function checkIps($ip){
            include('./../EpicClubRebootMisc/connect.php');
        	$ip = $_SERVER['REMOTE_ADDR'];
			$IpCheckQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `IP`='$ip'");
            $IpCheck = mysqli_num_rows($IpCheckQ);
            
    }
}
