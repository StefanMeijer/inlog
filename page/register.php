<?php
// Variables
$errors = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    inputFields();
}

/**
 * Check input fields
 * return checkUser function or error
 */
function inputFields()
{
    global $db, $errors;

    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password_1 = htmlspecialchars($_POST['password_1']);
    $password_2 = htmlspecialchars($_POST['password_2']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    if (count($errors) == 0) {
        checkUser($db, $errors, $username, $password_1, $email);
    }
}

/**
 * Check user details
 * @param (object) $db database connection
 * @param (array) $errors list of error messages
 * @param (string) $username filled in username
 * @param (string) $password_1 filled in password
 * @param (string) $email filled in email
 * return register function or error
 */
function checkUser($db, $errors, $username, $password_1, $email)
{
    global $db, $errors;

    $query = "SELECT username FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->execute(array(
    'username' => $username
    ));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response = null;

    if ($result) {
        array_push($errors, "Username is already taken");
    }

    if (count($errors) == 0) {
        register($db, $errors, $username, $password_1, $email);
    }
}

/**
 * Register the user
 * @param (object) $db database connection
 * @param (array) $errors list of error messages
 * @param (string) $username filled in username
 * @param (string) $password_1 filled in password
 * @param (string) $email filled in email
 * return user in database & login the new user
 */
function register($db, $errors, $username, $password_1, $email)
{
    $password = password_hash($password_1, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, user_type, password) VALUES ('$username', '$email', 'user', '$password')";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $logged_in_user_id = $db->lastInsertId();

    $_SESSION['user'] = getUserById($logged_in_user_id, $db);
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php?page=userpage');
}

/**
 * User details of registered user
 * @param (string) $id string of last registered user
 * @param (object) $db database connection
 * return user details
 */
function getUserById($id, $db)
{
    global $db;
    $query = "SELECT * FROM users WHERE users_ID=" . $id;
    $stmt = $db->prepare($query);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

/**
 * Include the view of registerpage
 */
include_once('views/registerPage.php');
