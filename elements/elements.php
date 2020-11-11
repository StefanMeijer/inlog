<?php
//check if user is logged in
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}
//check if admin is logged in
function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

// Function to logout user
function logout()
{
    if (isset($_GET['logout']) && $_GET['logout'] == true) {
        session_destroy();
        unset($_SESSION['user']);
        header("location: index.php?page=login");
    }
}
logout();

//Displays errors
function display_error()
{
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error .'<br>';
        }
        echo '</div>';
    }
}
