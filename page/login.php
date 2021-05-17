<?php
$errors = array();

/**
 * Call the userValues() function if register_btn is clicked
 */
if (isset($_POST['login_btn'])) {
    userValues($errors);
}

/**
 * Check the form value's
 * @param (array) $errors list of error messages
 * return checkUser function or error
 */
function userValues($errors)
{
    global $db, $errors;

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        checkUser($db, $errors, $username, $password);
    }
}

/**
 * Check if a user exists
 * @param (object) $db database connection
 * @param (array) $errors list of error messages
 * @param (string) $username filled in username
 * @param (string) $password filled in password
 * return login function or error
 */
function checkUser($db, $errors, $username, $password)
{
    global $db, $errors;
    try {
        $query1 = "SELECT * FROM users WHERE username = ?";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute(array($username));
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if ($result) {
        $hash = $result["password"];

        if (password_verify($password, $hash)) {
            try {
                $query2 = "SELECT * FROM users WHERE username='$username' AND password='$hash' LIMIT 1";
                $stmt2  = $db->prepare($query2);
                $stmt2->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            if ($stmt2->rowCount() == 1) {
                $logged_in_user = $stmt2->fetch(PDO::FETCH_ASSOC);
                login($logged_in_user);
            }
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    } else {
        array_push($errors, "No user could be found with this username.");
    }
}

/**
 * Login the user
 * @param (array) $logged_in_user list of user details
 * return $_SESSION['user'] details of user
 */
function login($logged_in_user)
{
    if ($logged_in_user['user_type'] == 'admin') {
        $_SESSION['user'] = $logged_in_user;
        header('location: index.php?page=admin');
    } else {
        $_SESSION['user'] = $logged_in_user;
        header('location: index.php?page=userpage');
    }
}

/**
 * Include the view of loginpage
 */
include_once('views/inlogPage.php');
