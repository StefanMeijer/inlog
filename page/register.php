<?php
// Variables
$errors = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
    inputFields();
}

//  Check input fields
function inputFields()
{
    // Global variables
    global $db, $errors;

    //  Receive all input values from the form.
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password_1 = htmlspecialchars($_POST['password_1']);
    $password_2 = htmlspecialchars($_POST['password_2']);

    // Make sure form is filled in correctly
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

function checkUser($db, $errors, $username, $password_1, $email)
{
    //  Query that checks if email already exists
    $query = "SELECT username FROM users WHERE username = :username";
    $stmt = $db->prepare($query);
    $stmt->execute(array(
    'username' => $username
    ));
    //username
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $response = null;

    //  Check if username already exists
    if ($result) {
        array_push($errors, "Username is already taken");
        //header("location: index.php?page=register'");
    }

    //  If no errors accur, try to register
    if (count($errors) == 0) {
        register($db, $errors, $username, $password_1, $email);
    }
}

function register($db, $errors, $username, $password_1, $email)
{
    //  Encrypt the password before saving in the database
    $password = password_hash($password_1, PASSWORD_DEFAULT);

    //  Insert user into database
    $query = "INSERT INTO users (username, email, user_type, password) VALUES ('$username', '$email', 'user', '$password')";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Get id of the created user
    $logged_in_user_id = $db->lastInsertId();

    // Log in user that has been created
    $_SESSION['user'] = getUserById($logged_in_user_id, $db);
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php?page=userpage');
}

// return user array from their id
function getUserById($id, $db)
{
    global $db;
    //Take a note on users_ID, could change if wrong
    $query = "SELECT * FROM users WHERE users_ID=" . $id;
    $stmt = $db->prepare($query);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

//  Include the view of register
include_once('views/registerPage.php');
