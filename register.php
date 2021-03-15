<?php
/**
 * Registering file, to make new accounts on EpicClub
 * @author Shiggy
 * @var $_COOKIE['EPICNAME'] - The username saved on cookies apparently.
 * @var $_['EPICPASS'] - Password saved on cookies, i personally dont find it secure.
 */

/**
 * Check for the cookies.
 *
 * If the cookies are set we just leave them in ../
 */

if (ISSET($_COOKIE['EPICNAME']) || ISSET($_COOKIE['EPICPASS']))
{
    header("Location: ../");
    exit;
}
// RegEx based on roblox.
$re = '/\\A[a-z\\d]+(?:[.-][a-z\\d]+)*\\z/i';

/**
 * Database Connection File
 */
include ($_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/connect.php');

// Note: Removed the email check at the beginning due it being quite useless.

/**
 * Registering Values.
 * @var username Username value.
 * @var pre_password Value of the first password.
 * @var password2 Value of the second password.
 * @var email User's email
 * @var gender User gender, possibly going to be deleted due to the state of the world as of 2021.
 */
$username = mysqli_real_escape_string($conn, $_POST['username']);
$pre_password = mysqli_real_escape_string($conn, $_POST['password1']);
$password2 = mysqli_real_escape_string($conn, $_POST['password2']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$gender = mysqli_real_escape_string($conn, $_POST['gender']);
# Updated the names of the values to be underscore.

/**
 * Check username lenght.
 */

/**
 * Check of passwords.
 * @todo Update the error handling.
 */

/**
 * If the RegEx does not match
 */
if (!preg_match_all($re, $username))
{

    include ($_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/HTMLS/InvalidUserSyntax.html');

}
else
{
    /**
     * If the RegEx matches, check the username lenght.
     *
     * @var UsernameL Lenght of the username.
     *
     * The check undergoes wether the username is less than 4 or higher than 20
     * @todo Update the error handling here too.
     */

}

$ip = $_SERVER['REMOTE_ADDR'];
$IpCheckQ = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `IP`='$ip'");
$IpCheck = mysqli_num_rows($IpCheckQ);

if ($IpCheck > 2)
{
    include ($_SERVER['DOCUMENT_ROOT'] . '/EpicClubRebootMisc/HTMLS/3Accounts.html');
    exit;
}

// check if they have an account (username Taken)
$AccountQuery = mysqli_query($conn, "SELECT * FROM `ec_users` WHERE `USERNAME` = '$username'");
$Account = mysqli_num_rows($AccountQuery);
if ($Account < 1)
{
    // Note: Soon i will update to bcrypt.
    $gosted = hash('gost', $pre_password);
    $password = hash('whirlpool', $gosted);
    $time = time();
    
    // Note: removed random string code due it being useless.

    setcookie('EPICNAME', $username, time() + 259200, '/');
    setcookie('EPICPASS', $password, time() + 259200, '/');

    echo "<script>window.location='/Dashboard/'</script>";
}

?>
