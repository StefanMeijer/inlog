<?php
//check if user is logged in
if (!isLoggedIn()) {
    header('location: index.php?page=login');
}


//  Upload CSV
if (isset($_FILES['uploadedfile'])) {
    csvImport($db, $_FILES['uploadedfile']);
}

if (isset($_POST['submit'])) {
    csvExport($db);
}

include_once('views/userPage.php');
