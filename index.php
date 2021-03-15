<?php

RegisteringFunctions::checkCookies();

if (isset($_GET['protocal']))
{
    // Check for cookies to stop redirecting loop
    if ($_GET['protocal'] == 'redirect')
    {
        if (isset($_COOKIE['EPICNAME']))
        {
            echo "<script>window.location='/Dashboard/'</script>";
        }
    }
}
else
{
    // Show index
    include_once 'EpicClubRebootMisc/HTMLS/index.html';
}
?>
