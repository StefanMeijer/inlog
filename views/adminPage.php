<?php
//Check if user is trying to escape GET methode
if (!isset($_GET["page"])) {
    echo 'Use website as expected.';
    exit;
}
?>

<div class="content">
    <!-- logged in user information -->
    <div class="profile_info">
        <div>
            <?php  if (isset($_SESSION['user'])) : ?>
            <strong><?php echo $_SESSION['user']['username']; ?></strong>

            <small>
                <i style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i>
            </small>

            <?php endif ?>
        </div>
    </div>
</div>