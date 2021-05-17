<?php
/**
 * Function to check if someone is logged in
 * return true or false
 */
function isLoggedIn()
{
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

/**
 * Function to check if admin is logged in
 * return true or false
 */
function isAdmin()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

/**
 * Function to logout users
 */
function logout()
{
    if (isset($_GET['logout']) && $_GET['logout'] == true) {
        session_destroy();
        unset($_SESSION['user']);
        header("location: index.php?page=login");
    }
}
logout();

/**
 * Function to display errors
 * @param (array) $errors list of error messages
 * return echo html
 */
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

/**
 * Function to import CSV files
 * @param (object) $db database connection
 * @param (array) $uploadedFile list of uploaded files
 * return echo succes or die
 */
function csvImport($db, $uploadedFile)
{
    $regex = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if (in_array($uploadedFile['type'], $regex)) {
        $file = $_FILES['uploadedfile']['tmp_name'];
        $handle = fopen($file, "r");
        
        try {
            // [NOTE]:This has to change on CSV file data
            $query_importCSV = $db->prepare("INSERT INTO csv (csv_ID, username, firstname, lastname) VALUES (?, ?, ?, ?)");

            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $query_importCSV->execute($data);
            }
            fclose($handle);

            echo 'Import succesful';
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    } else {
        die("Sorry, this type of file is NOT allowed.");
    }
}

/**
 * Function to export CSV files
 */
function csvExport()
{
}
