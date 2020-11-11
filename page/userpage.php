<?php
//check if user is logged in
if (!isLoggedIn()) {
    header('location: index.php?page=login');
}

include_once('views/userPage.php');