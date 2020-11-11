<?php
//Check if user is trying to escape GET methode
if (!isset($_GET["page"])) {
    echo 'Use website as expected.';
    exit;
}
?>

<div class="header">
    <h2>Admin - create user</h2>
</div>

<form method="post" action="">

    <?php echo display_error(); ?>

    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username"
            value="">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email"
            value="">
    </div>
    <div class="input-group">
        <label>User type</label>
        <select name="user_type" id="user_type">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="register_btn"> + Create user</button>
    </div>
</form>