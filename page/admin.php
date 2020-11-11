<?php
//check if admin is logged in
if (!isAdmin()) {
    header('location: index.php?page=login');
}

include_once('views/adminPage.php');
?>