<?php
// Start or resume the session
session_start();

// Function to get the value of a cookie or return null if it doesn't exist
function getCookieValue($cookieName)
{
    return isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;
}

// Check if the cookies var1 and var2 are set
if (isset($_COOKIE['var1'])) {
    // Retrieve the values of var1 and var2 from the cookies
    $var1 = getCookieValue('var1');
    $var2 = getCookieValue('var2');

    // Check if the values have changed
    if ($_SESSION['var1'] !== $var1 || $_SESSION['var2'] !== $var2) {
        // Values have changed, update PHP session variables
        $_SESSION['var1'] = $var1;
        $_SESSION['var2'] = $var2;
        echo "PHP variables updated: var1 = $var1, var2 = $var2";
    } else {
        echo "PHP variables not changed!";
    }
} else {
    echo "Cookies not set!";
}
