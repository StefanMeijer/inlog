<?php
//  Variables
$errors = array();

// Call the userValues() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
    userValues($errors);
}

//  Get user values
function userValues($errors)
{
    //  Global variables
    global $db, $errors;

    // Get form values
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Make sure form is filled in correctly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    //  If no errors accur, check the user
    if (count($errors) == 0) {
        checkUser($db, $errors, $username, $password);
    }
}

//  Check the user
function checkUser($db, $errors, $username, $password)
{
    //  Check if username exists in database
    try {
        $query1 = "SELECT * FROM users WHERE username = ?";
        $stmt1 = $db->prepare($query1);
        $stmt1->execute(array($username));
        $result = $stmt1->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    //  If username exists
    if ($result) {
        //  Hash password for comparing with database
        $hash = $result["password"];

        //  Check if password is correct with the username
        if (password_verify($password, $hash)) {
            try {
                $query2 = "SELECT * FROM users WHERE username='$username' AND password='$hash' LIMIT 1";
                $stmt2  = $db->prepare($query2);
                $stmt2->execute();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            // User found
            if ($stmt2->rowCount() == 1) {
                $logged_in_user = $stmt2->fetch(PDO::FETCH_ASSOC);
                login($logged_in_user);
            }
        } else {
            //  NOT DONE ASK TEACHER!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            //  Hij laat dit niet in de array zien, wat heel raar is.. print_r werkt wel
            array_push($errors, "Wrong username/password combination");
        }
    }
}

//  Login the user
function login($logged_in_user)
{
    // Check if user is admin or user
    if ($logged_in_user['user_type'] == 'admin') {
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: index.php?page=admin');
    } else {
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: index.php?page=userpage');
    }
}

//  Include the view of login
include_once('views/inlogPage.php');
